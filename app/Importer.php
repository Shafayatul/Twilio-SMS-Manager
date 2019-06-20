<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'importers';

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
    protected $fillable = ['name', 'group', 'phone_number'];

    
}
