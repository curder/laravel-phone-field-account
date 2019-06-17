<?php

namespace App\Http\Controllers\Traits;

use DB;
use PhpSms;
use Illuminate\Support\Str;
use Toplan\Sms\Facades\SmsManager;
use Illuminate\Support\Facades\Validator;

trait SmsCode
{
    public function __construct()
    {
        PhpSms::afterSend(function ($task, $result) {
            if (!config('laravel-sms.dbLogs', false) || !isset($task->data['_sms_id'])) {
                return true;
            }
            DB::transaction(function () use ($task) {
                $request = request();
                $dbData = [];
                // 增加自定义数据记录
                $dbData['request_name'] = Str::limit($request->get('request_name'), 250, '');
                $dbData['request_url'] = Str::limit($request->get('request_url'), 250, '');
                DB::table('laravel_sms')->where('id', $task->data['_sms_id'])->update($dbData);
            });
        });
    }

    /**
     * 发送验证码
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSmsCode(): \Illuminate\Http\JsonResponse
    {
        $result = SmsManager::validateSendable();
        if (!$result['success']) {
            return $this->formatResponseData($result);
        }

        $result = SmsManager::validateFields();
        if (!$result['success']) {
            return $this->formatResponseData($result);
        }

        $result = SmsManager::requestVerifySms();
        if (!$result['success']) {
            return $this->formatResponseData($result);
        }

        return response()->json($result);
    }

    /**
     * 校验验证码
     *
     * @return array
     */
    public function validateSmsCode()
    {
        // 验证数据
        $validator = Validator::make(request()->all(), [
            'phone' => 'required|confirm_mobile_not_change|confirm_rule:phone_required',
            'sms_code' => 'required|verify_code',
        ]);

        if ($validator->fails()) {
            // 验证失败后建议清空存储的发送状态，防止用户重复试错
            SmsManager::forgetState();

            return [
                'status' => false,
                'errors' => $validator->errors(),
            ];
        }

        return [
            'status' => true,
            'errors' => [],
        ];
    }

    protected function formatResponseData($result)
    {
        return response()->json([
            'message' => $result['message'],
            'errors' => ['phone' => [$result['message']]],
            'type' => $result['type'],
            'status' => $result['success'],
        ], 422);
    }
}
