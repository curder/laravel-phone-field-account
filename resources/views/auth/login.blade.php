@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <login action="{{ route('login') }}" method="post" reset-password="{{ route('password.request') }}"></login>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
