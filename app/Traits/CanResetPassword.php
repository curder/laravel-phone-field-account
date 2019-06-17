<?php
namespace App\Traits;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

/**
 * Trait CanResetPassword
 *
 * @package App\Http\Traits
 */
trait CanResetPassword
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        $field = $this->email;

        $route_name = request()->route()->getAction('as');

        if ($this->setFieldByPhone($route_name)) { // 使用手机号找回密码
            $field = $this->phone;
        }

        return $field;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @param $route_name
     *
     * @return bool
     */
    protected function setFieldByPhone($route_name): bool
    {
        return in_array($route_name, [
             'password.phone', 'password.update'
        ]);
    }
}
