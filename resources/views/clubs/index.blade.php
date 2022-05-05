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
                        {{ __('Clubs') }}
                        @can('create', \App\Models\Club::class)
                            <a href="{{ route('clubs.create') }}" class="btn btn-primary btn-sm float-end">Add</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th width="100px">Teams</th>
                                    <th width="200px">Number of Club Admins</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clubs as $club)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $club->name }}</td>
                                        <td align="center">
                                            <a href="{{ route('clubs.team', $club->id) }}">
                                            {{ $club->teams->count() }}
                                            </a>
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('clubs.admin', $club->id) }}">
                                            {{ $club->clubAdmins->count() }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex">
                                                @can('update', [\App\Models\Club::class, $club])
                                                <a href="{{ route('clubs.edit', $club->id) }}" class="" style="margin-right: 4px">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endcan

                                                @can('delete', [\App\Models\Club::class, $club])
                                                <form method="post" action="{{ route('clubs.destroy', $club->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                                </form>
                                                @endcan
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
