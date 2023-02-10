@extends('client.index')
@section('index.content')
    <div class="container__postList" id="container__postList" style="padding-top: 0px">
        @foreach ($posts as $post)
            <div class="post-item">
                <div class="post-item__details">
                    <div class="post-item__details--title">
                        <a href="{{ route('client.post.view', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </div>
                    <div class="post-item__details--metaData">
                    <span class="genre">{{ $category->name }}</span>
                    <span class="uploader"> · <a href={{ route("client.profile.view",  $post->author->id) }}>{{ $post->author->name }}</a> · </span>
                    <span class="date">{{ date_format($post->created_at, 'd/m/Y') }}</span>
                    </div>
                </div>
                <div class="post-item__cover">
                    <a href="{{ route('client.post.view', $post->slug) }}">
                        <img
                        src="{{  !empty($post->thumb)  ? asset('upload/post_images/'. $post->thumb) : asset('/upload/no_image.jpg')  }}"
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
        <button class="container__postList__more" id="category_more">Xem thêm</button>
    </div>
@endsection
