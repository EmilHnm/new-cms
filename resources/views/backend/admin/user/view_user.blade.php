@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        <h3 class="box-title">User List</h3>
                        <a href="{{ route('admin.user.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add user</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $index => $user)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $user->roles[0]->name ?? '-'}}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-info mb-5">Edit</a>
                                            <a href="{{ route('admin.user.delete',$user->id) }}" class="btn btn-danger mb-5" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:5%">SL</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
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
