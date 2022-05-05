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
                        <a href="{{ route('teams.index') }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ $team->name }}{{ __('\'s Player Groups') }}</span>
                        @can('create', \App\Models\PlayerGroup::class)
                            <a href="{{ route('player.group.create', $team->id) }}" class="btn btn-primary btn-sm float-end">Add</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <td>Players</td>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team->playerGroups as $playerGroup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $playerGroup->name }}</td>
                                    <td>
                                        <a href="{{ route('players.index', $playerGroup->id) }}">
                                            {{ $playerGroup->players->count() }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex">
                                            @can('update', [\App\Models\PlayerGroup::class, $playerGroup])
                                                <a href="{{ route('player.group.edit', $playerGroup->id) }}" class="" style="margin-right: 4px">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                            @endcan

                                            @can('delete', [\App\Models\PlayerGroup::class, $playerGroup])
                                                <form method="post" action="{{ route('player.group.delete', $playerGroup->id) }}">
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
