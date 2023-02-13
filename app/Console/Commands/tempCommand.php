<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class tempCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'temp:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $this->uploadThumbToS3();
        return Command::SUCCESS;
    }

    public function uploadThumbToS3()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            try {
                if (!empty($post->thumb)) {
                    Storage::cloud()->put(
                        'hoanm_img/' . $post->thumb,
                        file_get_contents(public_path('upload/post_images') . '/' . $post->thumb,)
                    );
                    $this->info('Upload success post' . $post->id);
                } else {
                    $this->info('Post' . $post->id . ' has no thumb');
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
