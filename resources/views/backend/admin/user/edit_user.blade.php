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
                        <form method="post" action="{{ route('admin.user.update', $editData->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Username <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" required="" value="{{ $editData->name }}">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Password </h5>
                                                <div class="controls">
                                                    <input type="password" name="password" class="form-control" value="">
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Password Confirmation</h5>
                                                <div class="controls">
                                                    <input type="password" name="password_confirmation" class="form-control" value="">
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>User Role</h5>
                                                <div class="controls">
                                                    <select name="role" value="" id="role" required="" class="form-control">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" {{ count($editData->roles) ? ($editData->roles[0]->id == $role->id ? 'selected' : '') : ""}}>{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>User Permission <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <div class="demo-checkbox">
                                                        @foreach ($permissions as $permission)
                                                            <input type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" name="permissions[]" class="filled-in chk-col-info">
                                                            <label for="{{$permission->id}}">{{$permission->name}}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @error('permissions')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                <div class="text-xs-left">
                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                                    <a href="{{ route('admin.user.view') }}" class="btn btn-rounded btn-secondary mb-5" >Cancel</a>
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
<script>
const roleSelect = document.getElementById('role');
const permissionCheckboxes = document.querySelectorAll('input[type="checkbox"]');
const permissionCheckboxesArray = Array.from(permissionCheckboxes);
let abortController = null;
let signal = null;
document.addEventListener('DOMContentLoaded', () => {
    let selectedRole = roleSelect.value;
    if(selectedRole)
        fetch(`{{ route('admin.role.permission') }}?role=${selectedRole}`, {
            method: 'GET',
            signal: signal
        })
            .then(response => response.json())
            .then(data => {
                permissionCheckboxesArray.forEach(node => {
                    if(data.includes(parseInt(node.value))) {
                        node.checked = true;
                        node.disabled = true;
                    } else {
                        node.checked = false;
                        node.disabled = false;
                    }
                });
            });
});
roleSelect.addEventListener('change', (e) => {
    const selectedRole = e.target.value;
    if(abortController) {
        abortController.abort();
        abortController = new AbortController();
    } else {
        abortController = new AbortController();
    }
    signal = abortController.signal;
    fetch(`{{ route('admin.role.permission') }}?role=${selectedRole}`, {
        method: 'GET',
        signal: signal
    })
        .then(response => response.json())
        .then(data => {
            permissionCheckboxesArray.forEach(node => {
                if(data.includes(parseInt(node.value))) {
                    node.checked = true;
                    node.disabled = true;
                } else {
                    node.checked = false;
                    node.disabled = false;
                }
            });
        });
})
</script>

@endsection
