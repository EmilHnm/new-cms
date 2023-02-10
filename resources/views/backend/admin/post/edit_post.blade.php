@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                <h4 class="box-title">Add Post</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('admin.post.update', $post->id) }}" enctype='multipart/form-data'>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Title <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="title" class="form-control" required="" value="{{ $post->title }}">
                                                    </div>
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Slug </h5>
                                                    <div class="controls">
                                                        <input type="text" name="slug" class="form-control" value="{{ $post->slug }}">
                                                    </div>
                                                    <span class="text-primary">Leave blank to auto generate from title</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5>Description <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="description" id="textarea" class="form-control" style="min-height:100px" required="" placeholder="Textarea text" aria-invalid="false">{{ $post->description }}</textarea>
                                                    <div class="help-block"></div></div>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5>Content <span class="text-danger">*</span></h5>
                                                    <textarea id="editor1" name="content" rows="10" cols="80" style="visibility: hidden; display: none;"
                                                    >{{ $post->content }}</textarea>
                                                    @error('content')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Category <span class="text-danger">*</span></h5>
                                                    {{-- <select name="category_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="" selected>Empty</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                    <div class="btn-group bootstrap-select btn-rounded ">
                                                        <select  name="category_id" class="selectpicker show-tick" data-live-search="true" tabindex="-98">
                                                            @foreach ($categories as $category)
                                                                <option {{ $category->id === $post->category_id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Tag <span class="text-danger">*</span></h5>
                                                    {{-- <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a Tag" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                        @foreach ($tags as $tag)
                                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                    <div  class="btn-group bootstrap-select btn-rounded show-tick">
                                                        <select class="selectpicker" id="tag_selection"  multiple="" data-placeholder="Select a Tag" data-live-search="true" data-actions-box="true" tabindex="-98">
                                                            @foreach ($tags as $tag)
                                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div id="tag_selection_container"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Thumb</h5>
                                                    <input type="file" name="thumb" id="thumb" class="form-control">
                                                    @error('thumb')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{  !empty($post->thumb)  ? asset('upload/post_images/'. $post->thumb) : asset('/upload/no_image.jpg')  }}" alt="" id="thumd_preview" srcset="" style="aspect-ratio: 1 / 1; width: 100px; height:auto; object-fit:contain; margin: auto">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Active <span class="text-danger">*</span></h5>
                                                    <input name="active" {{ $post->active == 1 ? "checked" : "" }} value="1" type="radio" class="with-gap" id="active">
                                                    <label for="active" >Active</label>
                                                    <input name="active" {{ $post->active == 0 ? "checked" : "" }} value="0" type="radio" id="inactive" class="with-gap">
                                                    <label for="inactive">Inactive</label>
                                                    @error('active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /.box -->

        </section>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', ()=>{
        const thumb = document.getElementById('thumb');
        const thumd_preview = document.getElementById('thumd_preview');
        thumb.addEventListener('change', (e)=>{
            const reader = new FileReader();
            reader.onload = (e)=>{
                thumd_preview.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

@endsection
