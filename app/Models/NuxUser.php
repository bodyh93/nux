<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NuxUser extends Model
{
//    protected $table = 'nux_users';
    protected $fillable = [
        'username',
        'phonenumber',
    ];
}
