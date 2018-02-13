<?php
namespace app\index\validate;

use think\Validate;

class CompanyInfo extends Validate
{
    protected $rule = [
		//验证必填，并且user表里面存在该字段
        //'name'         => 'require|unique:user',
        'company_name'         => 'require|max:50',
		'welcome_word'           => 'max:50',
	];

    protected $message = [
        'company_name.require'         => '请输入企业名称',
        'company_name.max'          => '企业名称超出长度',
		'welcome_word.length'            => '欢迎语长度错误',
	];
}