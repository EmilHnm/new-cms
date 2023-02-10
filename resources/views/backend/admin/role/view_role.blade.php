@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        <h3 class="box-title">Role List</h3>
                        <a href="{{ route('admin.role.add') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Role</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $index => $role)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-xl badge-primary">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.role.edit',$role->id) }}" class="btn btn-info mb-5">Edit</a>
                                            <a href="{{ route('admin.role.delete',$role->id) }}" class="btn btn-danger mb-5" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:5%">SL</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
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
