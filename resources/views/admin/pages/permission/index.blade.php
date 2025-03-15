@extends('admin.layout.master')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Update Permission</h1>
        <button type="submit" class="btn btn-primary save-btn px-4 d-block">Save</button>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="permissionForm" method="POST" action="{{ route('role.permission.update', $role->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach ($permissions as $key => $group)
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title text-capitalize">{{ $key }}</h5>
                                            <div>
                                                <input type="checkbox" class="group">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0" style="list-style: none">
                                                @foreach ($group as $permission)    
                                                    <li>
                                                        <input type="checkbox" id="group{{ $permission->id }}" name="group[]" value="{{ $permission->id }}" {{ $permission }} {{ $role->permissions->contains('id', $permission->id) ? "checked" : ''}} >
                                                        <label for="group{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".save-btn").addEventListener("click", function (event) {
                event.preventDefault(); // Prevent default button behavior (optional)
                document.getElementById("permissionForm").submit(); // Submit the form
            });
        });
    </script>
@endpush