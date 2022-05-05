@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('clubs.index') }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ __('Add new club') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('clubs.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-md-12 control-label">Name</label>

                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? '' }}"  required >
                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if(auth()->user()->isSuperAdmin())
                                <div class="form-group">
                                    <label for="club_admin" class="col-md-12 control-label">Select Club Admin</label>

                                    <div class="col-md-12">
                                        <select name="club_admin" id="club_admin" class="form-control"  required >
                                            @foreach($clubAdmins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

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
