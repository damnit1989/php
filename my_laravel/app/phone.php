<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    //
    // protected $table = 'phone';
    public static function getPhoneById($id){
        return self::find($id);
    }
}
