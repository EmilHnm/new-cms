@extends('client.client_master')
@section('client')
<main class="post-container">
      <div class="top">
        <div class="top__back">
          <div class="back-icon">
            <img src="{{ asset('assets/icons/client/icon-back.svg') }}" alt="" />
          </div>
          <a href={{ URL::previous() }} class="back-text">Quay lại</a>
        </div>
        <div class="top__genre">
          <span>Chuyên mục:</span>
          <a href="{{ route('client.category.post.view', $post->category->slug) }}" class="genre active">{{ $post->category->name }}</a>
        </div>
      </div>
      <h1 class="title">
        {{ $post->title }}
      </h1>
      <div class="control">
        <div class="control__metadata">
          <div class="control__metadata--genre">{{ $post->category->name }}</div>
          <div class="control__metadata--author">· {{ $post->author->name }} ·</div>
          <div class="control__metadata--date">{{ date_format($post->created_at, 'd/m/Y') }}</div>
        </div>
        <div class="control__social">
          <button class="light-gray">
            <img src="{{ asset('assets/icons/client/icon-mail.svg') }}" alt="" srcset="" />
            <span>Gửi mail</span>
          </button>
          <button class="blue">
            <img src="{{ asset('assets/icons/client/icon-facebook.svg') }}" alt="" srcset="" />
            <span>Chia sẻ</span>
          </button>
          <button class="white">
            <img src="{{ asset('assets/icons/client/icon-heart.svg')  }}" alt="" srcset="" />
            <span>Lưu</span>
          </button>
        </div>
      </div>
      <div class="content">
        <p class="text-gray-500 pb-5">
            {{ $post->description }}
        </p>
        {!! $post->content !!}
      </div>
      <span class="block pb-5 text-sm text-gray-500">Views: {{ $post->views }}</span>
      <div class="tag-list">
        @foreach ($post->tag as $tag)
            <a class="tag">#{{$tag->name}}</a>
        @endforeach
      </div>
      <aside>
        @if($post_same_category->count() > 0)
            <div class="same-genre">
            <div class="same-genre__top">
                <h3 class="same-genre__top--title">
                <span>Tin cùng chuyên mục</span>
                <a href={{ route('client.category.post.view', $post->category->slug) }} class="genre active">{{ $post->category->name }}</a>
                </h3>
                <a class="same-genre__top--view-all" href="{{ route('client.category.post.view', $post->category->slug) }}">
                    <span class="text">Xem tất cả</span>
                    <img class="icon" src="{{ asset('assets/icons/client/icon-next.svg')  }}" />
                </a>
            </div>
            <div class="same-genre">
                @foreach ($post_same_category as $post_same)
                    <div class="post-item">
                        <div class="post-item__details">
                            <div class="post-item__details--title">
                                <a href={{ route("client.post.view", $post_same->slug) }}>
                                    {{ $post_same->title }}
                                </a>
                            </div>
                            <div class="post-item__details--metaData">
                                <span class="genre">{{ $post_same->category->name }}</span>
                                <span class="uploader"> · {{ $post_same->author->name }} · </span>
                                <span class="date">{{ date_format($post_same->created_at, 'd/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="post-item__cover">
                            <img
                            src="{{  !empty($post_same->thumb)  ? asset('upload/post_images/'. $post_same->thumb) : asset('/upload/no_image.jpg')  }}"
                            alt=""
                            class="cover"
                            />
                        </div>
                        <div class="post-item__sumary">
                            {{  $post_same->description }}
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        @endif
        @if ($post_popular->count() > 0)
            <div class="popular">
                <div class="popular__top">
                    <h3 class="popular__top--title">
                        <span>Tin thịnh hành</span>
                    </h3>
                    <a href="./popular.html" class="popular__top--view-all">
                        <span class="text">Xem tất cả</span>
                        <img class="icon" src="{{ asset('assets/icons/client/icon-next.svg')  }}" />
                    </a>
                </div>
                <div class="popular">
                    @foreach ($post_popular as $popular)
                      <div class="post-item">
                          <div class="post-item__details">
                              <div class="post-item__details--title">
                                <a href={{ route("client.post.view", $popular->slug) }}>
                                    {{ $popular->title }}
                                </a>
                              </div>
                              <div class="post-item__details--metaData">
                                    <span class="genre">
                                    <a href={{ route('client.category.post.view',$popular->category->slug) }}>{{ $popular->category->name }}</a>
                                    </span>
                                    <span class="uploader"> · {{ $popular->author->name }} · </span>
                                    <span class="date">{{ date_format($popular->created_at, 'd/m/Y') }}</span>
                              </div>
                          </div>
                          <div class="post-item__cover">
                              <img
                              src="{{  !empty($popular->thumb)  ? asset('upload/post_images/'. $popular->thumb) : asset('/upload/no_image.jpg')  }}"
                              alt=""
                              class="cover"
                              />
                          </div>
                          <div class="post-item__sumary">
                              {{  $popular->description }}
                          </div>
                      </div>
                    @endforeach
                </div>
            </div>
        @endif
      </aside>
    </main>
@endsection
