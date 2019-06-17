<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('sms/send-code', 'SmsController@sendSmsCode'); // 发送短信验证码到手机
