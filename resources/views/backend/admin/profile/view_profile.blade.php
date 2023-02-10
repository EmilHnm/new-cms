@extends('admin.admin_master')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box box-widget widget-user">
                        <div class="widget-user-header bg-black" >
                        <h3 class="widget-user-username">{{ $user->name }}</h3>
                        <a href="{{ route('admin.profile.edit') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Edit Profile</a>
                        </div>
                        <div class="widget-user-image">
                        <img class="rounded-circle" src="{{  !empty($user->image)  ? ('/upload/user_images/'.$user->image) : asset('upload/user3-128x128.jpg')  }}" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="description-block">
                                <h5 class="description-header">Role</h5>
                                <span class="">{{ $user->roles[0]->name ?? '-' }}</span>
                            </div>
                            </div>
                            <div class="col-sm-6 bl-1">
                            <div class="description-block">
                                <h5 class="description-header">Email</h5>
                                <span class="">{{ $user->email }}</span>
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
