<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';
    protected $fillable = [
        'key',
        'value'
    ];
}