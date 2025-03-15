@extends('admin.layout.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Roles</h1>
    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="text-end mb-4">
                        <a href="{{ route('role.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->slug != 'super-admin')
                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('role.permission.index', $role->id) }}" class="btn btn-warning">Permission</a>
                                        <a href="{{ route('role.delete', $role->id) }}" class="btn btn-danger">Delete</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection