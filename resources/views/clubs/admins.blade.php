@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('clubs.index') }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ $club->name }}{{ __('\'s Admins') }}</span>

                        @can('create', [\App\Models\Club::class, $club])
                            <a href="{{ route('clubs.add.admin', $club->id) }}" class="btn btn-primary btn-sm float-end">Add Club Admin</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="100px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @can('delete', [\App\Models\Club::class, $club])
                                        <div class="d-inline-flex">
                                            <form method="post" action="{{ route('clubs.remove.admin', ['club' => $club->id, 'admin' => $admin->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                        @endcan
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
