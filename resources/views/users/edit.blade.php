@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ __('Edit user') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <div class="form-group">
                                <label for="name" class="col-md-12 control-label">Name</label>

                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $user->name }}"  required >
                                    @if ($errors->has('name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-12 control-label">Email</label>

                                <div class="col-md-12">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ?? $user->email }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-12 control-label">Password</label>

                                <div class="col-md-12">
                                    <input type="password" name="password" id="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-md-12 control-label">Confirm Password</label>

                                <div class="col-md-12">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="col-md-12 control-label">Photo</label>

                                <div class="col-md-12">
                                    <input type="file" name="photo" id="photo" class="form-control">
                                    <a target="_blank" href="{{ $user->getFirstMediaUrl('users') }}" style="margin-top: 5px">
                                        <img src="{{ $user->getFirstMediaUrl('users', 'thump') }}" width="auto" height="100px" />
                                    </a>
                                    @if ($errors->has('photo'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role" class="col-md-12 control-label">Role</label>

                                <div class="col-md-12">
                                    <select name="role" id="role" class="form-control" required>
                                        @foreach($roles as $role)
                                            <option {{ $user->role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('role'))
                                    <span class="help-block text-danger">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div style="margin-top: 15px">
                                <a href="{{ url()->previous() }}" type="button" class="btn btn-outline-info" >Cancel</a>
                                <button type="submit" class="btn btn-primary" >Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
