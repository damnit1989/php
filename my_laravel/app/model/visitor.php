<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class visitor extends Model
{
    //
    protected $table = 'visitor';

    public static function getVisitorById($id){
        return self::find($id);
    }
}
