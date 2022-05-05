@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ __('Edit player details') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('players.update', $player->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name" class="col-md-12 control-label">Name</label>

                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $player->name }}"  required >
                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo" class="col-md-12 control-label">Photo</label>

                                <div class="col-md-12">
                                    <input type="file" name="photo" id="photo" class="form-control">
                                    <a target="_blank" href="{{ $player->getFirstMediaUrl('players') }}" style="margin-top: 5px">
                                        <img src="{{ $player->getFirstMediaUrl('players', 'thump') }}" width="auto" height="100px" />
                                    </a>
                                    @if ($errors->has('photo'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div style="margin-top: 15px">
                                <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-info" >Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
