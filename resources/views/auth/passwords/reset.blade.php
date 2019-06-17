@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">

                    <reset-password token="{{ $token }}" action="{{ route('password.update') }}"></reset-password>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
