@extends('client.index')
@section('index.content')
@php
    $postController = new App\Http\Controllers\client\PostController();
    $hightlightPosts = $postController->PostHightlight();
    $posts = $postController->GetPosts();
    // dd($hightlightPosts);
@endphp
<div class="container__title">
    <svg
    width="36"
    height="40"
    viewBox="0 0 36 40"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    >
    <path
        d="M26.382 0C32.56 0 36 3.56 36 9.66V30.32C36 36.52 32.56 40 26.382 40H9.62C3.54 40 0 36.52 0 30.32V9.66C0 3.56 3.54 0 9.62 0H26.382ZM10.16 27.48C9.56 27.42 8.98 27.7 8.66 28.22C8.34 28.72 8.34 29.38 8.66 29.9C8.98 30.4 9.56 30.7 10.16 30.62H25.84C26.638 30.54 27.24 29.858 27.24 29.06C27.24 28.24 26.638 27.56 25.84 27.48H10.16ZM25.84 18.358H10.16C9.298 18.358 8.6 19.06 8.6 19.92C8.6 20.78 9.298 21.48 10.16 21.48H25.84C26.7 21.48 27.4 20.78 27.4 19.92C27.4 19.06 26.7 18.358 25.84 18.358ZM16.138 9.3H10.16V9.32C9.298 9.32 8.6 10.02 8.6 10.88C8.6 11.74 9.298 12.44 10.16 12.44H16.138C17 12.44 17.7 11.74 17.7 10.858C17.7 10 17 9.3 16.138 9.3Z"
        fill="#007882"
    />
    </svg>
    <span>Tin Tức</span>
</div>
<div class="container__post">
    <div class="container__post--highlight">
        <a href={{ route('client.post.view', $hightlightPosts[0]->slug) }} class="post">
            <div class="post__image">
                <img
                    class="cover"
                    src="{{  $hightlightPosts[0]->checkThumb()  ? $hightlightPosts[0]->thumb : asset('/upload/no_image.jpg')  }}"
                    alt=""
                    srcset=""
                />
                <img
                    class="save-post"
                    src="{{ asset('assets/icons/client/icon-heart.svg')  }}"
                    alt=""
                />
            </div>
            <div class="post__title">
                {{ $hightlightPosts[0]->title }}
            </div>
            <div class="post__details">
                <span class="post__details--genre">{{ $hightlightPosts[0]->category->name }}</span>
                <span class="post__details--uploader">
                    · {{ $hightlightPosts[0]->author->name }} ·
                </span>
                <span class="post__details--date">{{ date_format($hightlightPosts[0]->created_at, 'd/m/Y') }}</span>
            </div>
            <div class="post__sumary">
                {{ $hightlightPosts[0]->description }}
            </div>
        </a>
    </div>
    <div class="container__post--more">
        <div class="post">
            <div class="post__image">
                <a href={{ route('client.post.view', $hightlightPosts[1]->slug) }} >
                    <img
                        class="cover"
                        src="{{  $hightlightPosts[1]->checkThumb()  ?  $hightlightPosts[1]->thumb : asset('/upload/no_image.jpg')  }}"
                        alt=""
                        srcset=""
                    />
                </a>
                <img
                    class="save-post"
                    src="{{ asset('assets/icons/client/icon-heart.svg')  }}"
                    alt=""
                />
            </div>
            <div class="post__title">
                <a href={{ route('client.post.view', $hightlightPosts[1]->slug) }} >
                    {{ $hightlightPosts[1]->title }}
                </a>
            </div>
            <div class="post__details">
                <span class="post__details--genre">{{ $hightlightPosts[1]->category->name }}</span>
                <a href={{ route("client.profile.view",$hightlightPosts[1]->author->id) }} class="post__details--uploader">
                    · {{ $hightlightPosts[1]->author->name }} ·
                </a>
                <span class="post__details--date">{{ date_format($hightlightPosts[1]->created_at, 'd/m/Y') }}</span>
            </div>
            <div class="post__sumary">
                {{ $hightlightPosts[1]->description }}
            </div>
        </div>
        <div class="post">
            <div class="post__image">
                <a href={{ route('client.post.view', $hightlightPosts[2]->slug) }}>
                    <img
                        class="cover"
                        src="{{  $hightlightPosts[2]->checkThumb()  ?$hightlightPosts[2]->thumb : asset('/upload/no_image.jpg')  }}"
                        alt=""
                        srcset=""
                    />
                </a>
                <img
                    class="save-post"
                    src="{{ asset('assets/icons/client/icon-heart.svg')  }}"
                    alt=""
                />
            </div>
            <div class="post__title">
                <a href={{ route('client.post.view', $hightlightPosts[2]->slug) }}>
                    {{ $hightlightPosts[2]->title }}
                </a>
            </div>
            <div class="post__details">
                <span class="post__details--genre">{{ $hightlightPosts[2]->category->name }}</span>
                <a href={{ route("client.profile.view",$hightlightPosts[2]->author->id) }} class="post__details--uploader">
                    · {{ $hightlightPosts[2]->author->name }} ·
                </a>
                <span class="post__details--date">{{ date_format($hightlightPosts[2]->created_at, 'd/m/Y') }}</span>
            </div>
            <div class="post__sumary">
                {{ $hightlightPosts[2]->description }}
            </div>
        </div>
    </div>
</div>
{{-- <div class="container__video">
    <div class="container__video__header">
    <h2 class="container__video__header--title">Video</h2>
    <a class="container__video__header--more">See more</a>
    </div>
    <div class="container__video__main">
    <div class="highlight" id="video-highlight">
        <div class="video">
        <div class="video__main">
            <img src="./assets/image/video-img-1.png" alt="" />
            <span class="playBtn">
            <svg
                width="34"
                height="41"
                viewBox="0 0 34 41"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M32.4359 16.98C32.2476 16.7867 31.5364 15.96 30.874 15.28C26.9902 11.0033 16.8587 4.00333 11.5559 1.86667C10.7506 1.52333 8.71452 0.796667 7.62668 0.75C6.58431 0.75 5.59064 0.99 4.64244 1.47667C3.46043 2.15667 2.51222 3.22667 1.99265 4.49C1.65818 5.36667 1.13862 7.99 1.13862 8.03667C0.619057 10.9067 0.333294 15.57 0.333294 20.7233C0.333294 25.6333 0.619053 30.1067 1.04445 33.02C1.09316 33.0667 1.61272 36.3267 2.181 37.4433C3.22337 39.4833 5.25942 40.75 7.43834 40.75H7.62668C9.04575 40.7 12.03 39.4333 12.03 39.3867C17.047 37.2467 26.9448 30.59 30.9227 26.1667C30.9227 26.1667 32.043 25.03 32.5301 24.32C33.2899 23.3 33.6666 22.0367 33.6666 20.7733C33.6666 19.3633 33.2412 18.05 32.4359 16.98Z"
                fill="white"
                />
            </svg>
            </span>
        </div>
        <div class="video__details">
            <h4 class="video__details--title">
            Đi dạo cạnh đường cao tốc Pháp Vân Cầu Giẽ ổn không?
            </h4>
            <div class="video__details--metaData">
            <span class="views">5542 lượt xem · </span>
            <span class="date">24/02/2020</span>
            </div>
        </div>
        </div>
    </div>
    <div class="more" id="video-more">
        <div class="video">
        <div class="video__main">
            <img src="./assets/image/video-img-1.png" alt="" />
            <span class="playBtn">
            <svg
                width="34"
                height="41"
                viewBox="0 0 34 41"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M32.4359 16.98C32.2476 16.7867 31.5364 15.96 30.874 15.28C26.9902 11.0033 16.8587 4.00333 11.5559 1.86667C10.7506 1.52333 8.71452 0.796667 7.62668 0.75C6.58431 0.75 5.59064 0.99 4.64244 1.47667C3.46043 2.15667 2.51222 3.22667 1.99265 4.49C1.65818 5.36667 1.13862 7.99 1.13862 8.03667C0.619057 10.9067 0.333294 15.57 0.333294 20.7233C0.333294 25.6333 0.619053 30.1067 1.04445 33.02C1.09316 33.0667 1.61272 36.3267 2.181 37.4433C3.22337 39.4833 5.25942 40.75 7.43834 40.75H7.62668C9.04575 40.7 12.03 39.4333 12.03 39.3867C17.047 37.2467 26.9448 30.59 30.9227 26.1667C30.9227 26.1667 32.043 25.03 32.5301 24.32C33.2899 23.3 33.6666 22.0367 33.6666 20.7733C33.6666 19.3633 33.2412 18.05 32.4359 16.98Z"
                fill="white"
                />
            </svg>
            </span>
        </div>
        <div class="video__details">
            <h4 class="video__details--title">
            Đi dạo cạnh đường cao tốc Pháp Vân Cầu Giẽ ổn không?
            </h4>
            <div class="video__details--metaData">
            <span class="views">5542 lượt xem · </span>
            <span class="date">24/02/2020</span>
            </div>
        </div>
        </div>
    </div>
    </div>
</div> --}}
<div class="container__postList">
    <h4 class="container__postList__header">Danh sách tin</h4>
    @foreach ($posts as $index => $post)
        <div class="post-item">
            <div class="post-item__details">
                <div class="post-item__details--title">
                    <a href="{{ route('client.post.view', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </div>
                <div class="post-item__details--metaData">
                <span class="genre">
                    <a href={{ route("client.category.post.view",  $post->category->slug) }}>
                        {{ $post->category->name }}
                    </a>
                </span>
                <span class="uploader"> · <a href={{ route("client.profile.view",  $post->author->id) }}>{{ $post->author->name }}</a> · </span>
                <span class="date">{{ date_format($post->created_at, 'd/m/Y') }}</span>
                </div>
            </div>
            <div class="post-item__cover">
                {{-- <a href="{{ route('client.post.view', $post->slug) }}">
                    <img
                    src="{{  !empty($post->thumb)  ? asset('upload/post_images/'. $post->thumb) : asset('/upload/no_image.jpg')  }}"
                    alt=""
                    class="cover"
                    />
                </a> --}}
                <a href="{{ route('client.post.view', $post->slug) }}">
                    <img
                    src="{{   $post->checkThumb()  ? $post->thumb : asset('/upload/no_image.jpg')  }}"
                    alt=""
                    class="cover"
                    />
                </a>
                <img src="{{ asset('assets/icons/client/icon-heart.svg')  }}" alt="" class="heart" />
            </div>
            <div class="post-item__sumary">
                {{ $post->description }}
            </div>
        </div>
    @endforeach
    <div class="container__postList__more">Xem thêm</div>
</div>
@endsection
