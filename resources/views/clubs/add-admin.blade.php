@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('clubs.admin', $club->id) }}" class="btn btn-outline-info btn-sm">Back</a>
                        <span style="margin-left: 10px">{{ __('Add club admin to ') }}{{ $club->name }}</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('clubs.add.admin', $club->id) }}">
                            @csrf

                            <div class="form-group">
                                <label for="club_admin" class="col-md-12 control-label">Select Club Admin</label>

                                <div class="col-md-12">
                                    <select name="club_admin" id="club_admin" class="form-control"  required >
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                        @endforeach
                                    </select>
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
