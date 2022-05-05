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
                        <a href="{{ url()->previous() }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ $group->name }}{{ __('\'s Players') }}</span>
                        @can('create', [\App\Models\Player::class, $group])
                            <a href="{{ route('players.create', $group->id) }}" class="btn btn-primary btn-sm float-end">Add</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <td>Photo</td>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $player->name }}</td>
                                    <td>
                                        <a target="_blank" href="{{ $player->getFirstMediaUrl('players') }}">
                                            <img src="{{ $player->getFirstMediaUrl('players', 'thump') }}" width="auto" height="100px" />
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex">
                                            @can('update', [\App\Models\Player::class, $player])
                                                <a href="{{ route('players.edit', $player->id) }}" class="" style="margin-right: 4px">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                            @endcan

                                            @can('delete', [\App\Models\Player::class, $player])
                                                <form method="post" action="{{ route('players.delete', $player->id) }}">
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
