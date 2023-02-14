<?php

namespace App\Console\Commands;

use DOMXPath;
use DOMDocument;
use Carbon\Carbon;
use App\Models\Post;
use GuzzleHttp\Client;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GetDailyPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:post {url=https://dantri.com.vn/} {--timeout=120.0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get daily post';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client([
            'timeout' => $this->option('timeout'),
        ]);
        $url = $this->argument('url');
        $response = null;
        $html = "";
        try {
            $response = $client->request('GET', $url);
            $html = $response->getBody()->getContents();
        } catch (\InvalidArgumentException $e) {
            $this->error('Invalid URL');
            return Command::FAILURE;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            $this->error('Connection timeout');
            return Command::FAILURE;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->error('Request error');
            return Command::FAILURE;
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $this->error('Guzzle error');
            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('Unknown error: ' . $e->getMessage());
            return Command::FAILURE;
        }
        if ($url == 'https://dantri.com.vn/' && $response->getStatusCode() == 200 && $html != "") {
            // Get latest post
            $this->getPostDanTri($client, $url, $html);
        }
        return Command::SUCCESS;
    }

    private function getPostDanTri(Client $client, string $url, string $html)
    {
        try {

            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);
            $element = $xpath->query("//article[@class='article-hot']/article[@class='article-item']");
            $thumb = $xpath->query("//article[@class='article-hot']/article[@class='article-item']/div[@class='article-thumb']");

            for ($i = 0; $i < $element->length; $i++) {
                $postUrl = $element->item($i)->getAttribute('data-content-target');

                $post_thumb = $thumb->item($i)->childNodes->item(1)->childNodes->item(1)->getAttribute('data-src');

                $this->info("Get Post Url Successfully!");
                $this->info("Post Url: " . $postUrl);

                // get latest post data
                $post_response = $client->request('GET', $url . $postUrl);
                $post_html = $post_response->getBody()->getContents();
                $this->info("Get Post Content Successfully!");

                $this->info("Extracting DOM...");
                $post_dom = new DOMDocument();
                @$post_dom->loadHTML($post_html);
                $post_xpath = new DOMXPath($post_dom);

                $this->info("Extracting DOM Successfully! Extracting Data");

                if ($post_xpath->query("//h1[@class='title-page detail']")->item(0))
                    $this->savePost($this->getNewpaperDantri($post_xpath, $post_thumb), $client);
                else {
                    $this->savePost($this->getMagazinesDantri($post_xpath), $client);
                }
            }
        } catch (\Exception $e) {
            $this->error('Unknown error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function getMagazinesDantri($post_xpath)
    {
        $post_thumb = $post_xpath->query("//div[@class='e-magazine__cover']/h1/img")->item(0)->getAttribute('src');
        $title = $post_xpath->query("//*[@class='align-center']")->item(0)->nodeValue;
        $category = "Magazines";
        $date = Carbon::now();
        $description = $post_xpath->query("//p")->item(0)->nodeValue;
        $contentDOM = $post_xpath->query("//div[@class='e-magazine__body']")->item(0);
        $content = "";
        foreach ($contentDOM->childNodes as $index => $childNode) {
            if ($childNode->nodeValue == $title || $childNode->nodeValue == $description) {
                continue;
            }
            if ($childNode->nodeName == 'figure') {
                foreach ($childNode->childNodes as $figureChildNode) {
                    if ($figureChildNode->nodeName == 'img') {
                        $figureChildNode->setAttribute('src', $figureChildNode->getAttribute('data-original'));
                    }
                }
            }
            $content .= $childNode->ownerDocument->saveXML($childNode);
        }

        return (object) [
            'title' => $title,
            'category' => $category,
            'date' => $date,
            'description' => $description,
            'content' => $content,
            'post_thumb' => $post_thumb
        ];
    }

    private function getNewpaperDantri($post_xpath, $post_thumb)
    {
        $title = $post_xpath->query("//h1[@class='title-page detail']")->item(0)->nodeValue;
        $category = $post_xpath->query("//ul[@class='breadcrumbs']/li/a")->item(0)->getAttribute('title');
        $date = $post_xpath->query("//time[@class='author-time']")->item(0)->getAttribute('datetime');
        $description = $post_xpath->query("//h2[@class='singular-sapo']")->item(0)->nodeValue;
        $contentDOM = $post_xpath->query("//div[@class='singular-content']")->item(0);
        $content = "";
        foreach ($contentDOM->childNodes as $childNode) {
            if ($childNode->nodeName == 'figure') {
                foreach ($childNode->childNodes as $figureChildNode) {
                    if ($figureChildNode->nodeName == 'img') {
                        $figureChildNode->setAttribute('src', $figureChildNode->getAttribute('data-original'));
                    }
                }
            }
            $content .= $childNode->ownerDocument->saveXML($childNode);
        }
        $content = str_replace('image align-center', '', $content);
        $description = str_replace('(Dân trí) - ', '', $description);
        return (object) [
            'title' => $title,
            'category' => $category,
            'date' => $date,
            'description' => $description,
            'content' => $content,
            'post_thumb' => $post_thumb
        ];
    }

    private function savePost($data, Client $client)
    {
        $this->info("Checking data exist... ");
        // check post exist
        $checkPost = Post::where('title', $data->title)
            ->where('description', 'LIKE', '%' . $data->description . '%')
            ->first();
        if ($checkPost) {
            $this->error("Post was exsist! ");
            return;
        }
        // save post
        $post = new Post();
        $post->title = $data->title;
        $post->slug = Str::slug($data->title);
        $post->description = $data->description;
        $post->content = $data->content;
        //check category exist
        $categoryCheck = Category::where('name', 'LIKE', '%' . $data->category . '%')->first();
        if ($categoryCheck) {
            $post->category_id = $categoryCheck->id;
        } else {
            $newCategory = new Category();
            $newCategory->name = $data->category;
            $newCategory->slug = Str::slug($data->category);
            $newCategory->save();
            $post->category_id = $newCategory->id;
        }
        $fileExtension = substr($data->post_thumb, strrpos($data->post_thumb, '.') + 1);
        $filename = date('YmdHi') . '-dantri-' . $post->slug . "." . $fileExtension;
        try {
            $client->request('GET', $data->post_thumb, [
                'sink' => public_path('upload/post_images') . '/' . $filename
            ]);
            Storage::cloud()->put('hoanm_img/' . $filename, file_get_contents(public_path('upload/post_images') . '/' . $filename,));
        } catch (\Throwable $th) {
            $this->error("Download image failed! ");
            return;
        }

        $post->thumb = $filename;

        $post->author_id = 10;

        $post->created_at = $data->date;
        $post->updated_at = $data->date;

        $post->save();

        $this->info("Post was saved! ");
        $this->info("===========================");
    }
}
