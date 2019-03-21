<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Captcha;

class CodeController extends Controller
{
    public function create()
    {
        $verify = new Captcha();
        $code = $verify->getCode();
        //var_dump($code);
        session(['verifycode'=>$code]);
        return $verify->doimg();
    }
}
