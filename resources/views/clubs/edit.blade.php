@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('clubs.index') }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ __('Edit club details') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('clubs.update', $club->id) }}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $club->id }}" />
                            <div class="form-group">
                                <label for="name" class="col-md-12 control-label">Name</label>

                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $club->name }}"  required >
                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div style="margin-top: 15px">
                                <a href="{{  route('clubs.index') }}" type="button" class="btn btn-outline-info" >Cancel</a>
                                <button type="submit" class="btn btn-primary" >Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
