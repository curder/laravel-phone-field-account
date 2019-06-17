@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <Login action="{{ route('login') }}" method="post" reset-password="{{ route('password.request') }}"></Login>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
