<?php
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
		//验证必填，并且user表里面存在该字段
        //'name'         => 'require|unique:user',
        'name'         => 'require|max:10',
        //'password'         => 'confirm:confirm_password',
        //'confirm_password' => 'confirm:password',
        'phone'           => 'number|length:11',
        'email'            => 'email',
        //'status'           => 'require',
    ];

    protected $message = [
        'name.require'         => '请输入用户名',
        'name.unique'          => '用户名已存在',
        //'password.confirm'         => '两次输入密码不一致',
        //'confirm_password.confirm' => '两次输入密码不一致',
        'phone.number'            => '手机号格式错误',
        'phone.length'            => '手机号长度错误',
        'email.email'              => '邮箱格式错误',
        //'status.require'           => '请选择状态'
    ];
}