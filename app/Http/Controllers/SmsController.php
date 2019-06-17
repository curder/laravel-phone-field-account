<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SmsCode;
use App\Http\Controllers\Controller;

/**
 * Class SmsController
 *
 * @package \App\Http\Controllers\Home
 */
class SmsController extends Controller
{
    use SmsCode;
}
