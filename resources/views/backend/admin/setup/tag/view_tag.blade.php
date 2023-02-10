@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        <h3 class="box-title">Tag List</h3>
                        <a href="{{ route('admin.tag.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Tag</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $index => $tag)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.tag.edit',$tag->id) }}" class="btn btn-info mb-5">Edit</a>
                                            <a href="{{ route('admin.tag.delete',$tag->id) }}" class="btn btn-danger mb-5" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:5%">SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created</th>
                                    <th style="width:20%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
