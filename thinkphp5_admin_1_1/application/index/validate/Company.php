<?php
namespace app\index\validate;

use think\Validate;

class Company extends Validate
{
    protected $rule = [
		//验证必填，并且user表里面存在该字段
        //'name'         => 'require|unique:user',
        'username'         => 'require|max:10',
        'password'         => 'confirm:confirm_password',
        'confirm_password' => 'confirm:password',
        'telphone'           => 'number|length:11',
        'email'            => 'email',
        'verify'   => 'require|captcha',		
        //'status'           => 'require',
    ];

    protected $message = [
        'username.require'         => '请输入用户名',
        'username.unique'          => '用户名已存在',
        'password.confirm'         => '两次输入密码不一致',
        'confirm_password.confirm' => '两次输入密码不一致',
        'telphone.number'            => '手机号格式错误',
        'telphone.length'            => '手机号长度错误',
        'email.email'              => '邮箱格式错误',
        'verify.require'   => '请输入验证码',
        'verify.captcha'   => '验证码不正确',		
        //'status.require'           => '请选择状态'
    ];
}