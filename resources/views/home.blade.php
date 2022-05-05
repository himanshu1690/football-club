@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->isSuperAdmin())
                        Welcome, Super Admin!
                    @endif

                    @if(auth()->user()->isClubAdmin())
                        @if(isset(auth()->user()->club))
                            Welcome to {{ auth()->user()->club->name }} Club.
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
