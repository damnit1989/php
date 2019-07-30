<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PhoneController extends Controller
{

    /**
     * 添加中间件
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(phone $phone)
    {

        try{
            // $phone = phone::getPhoneById(1);
            // return $phone;

            // throw new \Exception('success',200);
            throw new \Exception('failure',203);

        }catch(\Exception $e){

            // 两种方式调用宏 1-静态方法，2-类方法
            // return Response::caps($e);            
            return response()->caps($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(phone $phone)
    {
        //
        if(!$phone->delete()){
            return [
                'code' => 201,
                'msg' => '删除失败',
                'data' => []
            ];
        }

        return ['code' => 201,'msg' => '删除成功','data' => []];

    }
}
