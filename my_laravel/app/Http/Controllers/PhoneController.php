<?php

namespace App\Http\Controllers;

use App\phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
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
        //
        // $phone = phone::getPhoneById(1);
        return $phone;
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
