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
                        {{ __('Users') }}
                        @can('create', \App\Models\User::class)
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-end">Add</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a target="_blank" href="{{ $user->getFirstMediaUrl('users') }}">
                                                <img src="{{ $user->getFirstMediaUrl('users', 'thump') }}" width="auto" height="100px" />
                                            </a>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                @can('update', [\App\Models\User::class, $user])
                                                <a href="{{ route('users.edit', $user->id) }}" class="" style="margin-right: 4px">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endcan

                                                @can('delete', [\App\Models\User::class, $user])
                                                <form method="post" action="{{ route('users.destroy', $user->id) }}"  style="margin-right: 4px">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                                </form>
                                                @endcan

                                                @if($user->isClubAdmin())
                                                    @canImpersonate
                                                    <a href="{{ route('users.impersonate', $user->id) }}" style="margin-right: 4px">
                                                        <button class="btn btn-warning btn-sm"><i class="fa fa-user-secret"></i></button>
                                                    </a>
                                                    @endCanImpersonate
                                                @endif

                                            </div>
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
