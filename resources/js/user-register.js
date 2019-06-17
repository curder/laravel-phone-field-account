require('./utils/laravel-sms.js');

$(function() {
    const phone_rules = {
            register: 'register',
            reset_password: 'reset_password',
        },
        token =  $('meta[name="csrf-token"]').attr('content'),
        interval = 60,
        requestUrl = '/api/sms/send-code',
        phone_value = () => $("#phone").val(),
        language = {
            sending    : '短信发送中...',
            failed     : '请求失败，请重试',
            resendable : '{{seconds}} 秒后再次发送'
        },
        notifyCallback = (msg, type) => {
            if(type === 'sms_sent_success') {
                console.log(msg, type);
            } else {
                console.log(msg, type);
            }
        },
        types = { // 短信验证类型，后台通过这个类型发送不用的模版
            register: 'register', // 注册
            reset_password: 'reset_password', // 重置密码
        }
    ;

    $.ajaxSetup({
        beforeSend: (xhr) => {
            xhr.setRequestHeader('Access-Token',  phone_value());
        }
    });

    // 注册发送校验短信
    $("#sendRegisterVerifySmsButton").sms({
        //laravel csrf token
        token       : token,
        //请求间隔时间
        interval    : interval,
        // 请求地址
        requestUrl  : requestUrl,
        //语音验证码
        voice       : false,
        //请求参数
        requestData : {
            // 手机号
            phone: phone_value,
            // 手机号的检测规则，与配置文件中配置保持一致
            phone_rule: phone_rules.register,
            // 短信类型
            type: types.register,

            request_name: '用户注册',

            request_url: window.location.href,
        },
        //消息展示方式(默认为alert)
        notify : notifyCallback,

        //语言包
        language    : language
    });

    // 重置密码发送校验短信
    $("#sendResetVerifySmsButton").sms({
        //laravel csrf token
        token       : token,
        //请求间隔时间
        interval    : interval,
        // 请求地址
        requestUrl  : requestUrl,
        //语音验证码
        voice       : false,
        //请求参数
        requestData : {
            // 手机号
            phone : phone_value,
            // 手机号的检测规则，与配置文件中配置保持一致
            phone_rule : phone_rules.reset_password,
            // 短信类型
            type : types.reset_password,

            request_name: '重置密码',

            request_url: window.location.href,
        },
        //消息展示方式(默认为alert)
        notify : notifyCallback,

        //语言包
        language    : language
    });
});
