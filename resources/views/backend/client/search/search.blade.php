@extends('client.index')
@section('index.content')
    <div class="w-4/5 mx-auto my-2 ">
        <input type="text" id="search_box" class="w-full" placeholder="Nhập nội dung và nhấn Enter để  tìm kiếm" value={{ $query }}>
    </div>
    @if($posts)
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
                    <span class="genre">{{ $post->category->name }}</span>
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
            <div class="flex w-full justify-center mb-10">
                @if ($page->current_page != 1)
                    <a href="{{ $page->prev_page_url .'&q=' . $query  }}" class="inline-flex items-center px-4 py-2 mr-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        Previous
                    </a>
                @endif
                @if ($page->current_page != $page->last_page)
                    <a href="{{ $page->next_page_url.'&q=' . $query }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                        <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                @endif
            </div>
    </div>
    @endif
<script>

    let search_box = document.getElementById('search_box');
    search_box.addEventListener('keyup', function(e){
        if(e.keyCode == 13){
            let query = search_box.value;
            window.location.href = '/search/?q=' + query;
        }
    });

</script>
@endsection
