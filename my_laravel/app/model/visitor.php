<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class visitor extends Model
{
    //
    protected $table = 'visitor';

    const CREATED_AT = 'create_time';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'update_time';    

    public static function getVisitorById($id){
        return self::find($id);
    }
}
