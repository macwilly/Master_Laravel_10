<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // This is auto generated when Laravel is used to create the model
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
