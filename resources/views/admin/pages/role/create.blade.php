@extends('admin.layout.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Create Role</h1>
    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('role.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="roleName">Role Name</label>
                            <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter Name" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection