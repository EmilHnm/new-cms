@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
        <div class="box">
            <div class="box-header with-border">
            <h4 class="box-title">Update user</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>User Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" required value="{{ $editData->name }}">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>User Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" required value="{{ $editData->email }}">
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Profile Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input name="image" type="file" class="form-control" id="Img" >
                                                </div>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <img id="showImg" class="rounded-circle" src="{{  !empty($user->image)  ? ('upload/user_image/'.$user->image) : asset('/upload/user3-128x128.jpg')  }}" style="width:100px; height:100px; border: 1px solid #000" alt="User Avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="text-xs-left">
                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                                    <a href="{{ route('admin.profile.view') }}" class="btn btn-rounded btn-secondary mb-5" >Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', ()=>{
        const Img = document.getElementById('Img');
        const showImg = document.getElementById('showImg');
        Img.addEventListener('change', (e)=>{
            const reader = new FileReader();
            reader.onload = (e)=>{
                showImg.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
