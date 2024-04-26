<?php
namespace Beh7ad\User\Services;

class VerifyCodeService
{
    public static function generate()
    {
        return rand(100000 , 999999);
    }

    public static function store($id , $code)
    {
        return cache()->set('verify_code_' . $id , $code , now()->addDay());
    }
}
