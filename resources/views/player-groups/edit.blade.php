@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('player.group.index', $playerGroup->team->id) }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ __('Edit player group') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('player.group.update', $playerGroup->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name" class="col-md-12 control-label">Name</label>

                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $playerGroup->name }}"  required >
                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div style="margin-top: 15px">
                                <a href="{{ route('player.group.index', $playerGroup->team->id) }}" type="button" class="btn btn-outline-info" >Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
