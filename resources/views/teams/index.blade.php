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
                        {{ __('Teams') }}
                        @can('create', \App\Models\Team::class)
                            <a href="{{ route('teams.create') }}" class="btn btn-primary btn-sm float-end">Add</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if(auth()->user()->isSuperAdmin())
                                        <th>Club</th>
                                    @endif
                                    <th>Name</th>
                                    <td>Player Groups</td>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if(auth()->user()->isSuperAdmin())
                                            <td>{{ $team->club->name }}</td>
                                        @endif
                                        <td>{{ $team->name }}</td>
                                        <td>
                                            <a href="{{ route('player.group.index', $team->id) }}">
                                                {{ $team->playerGroups->count() }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex">
                                                @can('update', [\App\Models\Team::class, $team])
                                                <a href="{{ route('teams.edit', $team->id) }}" class="" style="margin-right: 4px">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endcan

                                                @can('delete', [\App\Models\Team::class, $team])
                                                <form method="post" action="{{ route('teams.destroy', $team->id) }}">
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
