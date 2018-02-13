<?php
namespace app\index\validate;

use think\Validate;

/**
 * 访客验证器
 * Class AdminUser
 * @package app\admin\validate
 */
class Visitor extends Validate
{
    protected $rule = [
        'visitor_name'         => 'require|max:10',
		'visitor_phone'           => 'number|length:11',
        'visitor_email'            => 'email',
        'member_id'           => 'require',		
    ];

    protected $message = [
        'visitor_name.require'         => '请输入用户名',
        'visitor_name.unique'          => '用户名已存在',
		'visitor_phone.number'            => '手机号格式错误',
        'visitor_phone.length'            => '手机号长度错误',
        'visitor_email.email'              => '邮箱格式错误',
        'member_id.require'           => '请选择拜访人',		
    ];
}