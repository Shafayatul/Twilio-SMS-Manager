<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CSV extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'c_s_vs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['group', 'fname', 'lname', 'phone', 'email','upload_by'];

    
}
