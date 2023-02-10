@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        <h3 class="box-title">Post List</h3>
                        <a href="{{ route('admin.post.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Post</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example5_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example5" class="table table-bordered table-striped dataTable" style="width:100%" role="grid" aria-describedby="example5_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Index: activate to sort column descending" style="width: 5%;">SL</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Slug: activate to sort column ascending" >Slug</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending" >Title</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Author: activate to sort column ascending" >Author</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Author: activate to sort column ascending" >Approvor</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Category: activate to sort column ascending" >Category</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" style="width: 20%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allData as $index => $post)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $index+1 }}</td>
                                                    <td>{{ $post->slug }}</td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->author->name ?? '-' }}</td>
                                                    <td>{{ $post->approvor->name ?? '-'}}</td>
                                                    <td>{{ $post->category->name ?? '-'}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.post.edit',$post->id) }}" class="btn btn-info mb-5">Edit</a>
                                                        <a href="{{ route('admin.post.delete',$post->id) }}" class="btn btn-danger mb-5" id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Slug">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Title">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Author">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Approvor">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Category">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
