<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // This is auto generated when Laravel is used to create the model
    use HasFactory;

    /**
     * Specifically select the fillable table columns all others will not be filled
     * This is considered ore secure.
     */
    protected $fillable = ['title', 'description', 'long_description'];
    /**
     * Specifically select the non-fillable table columns all others will be fillable
     * this is useful for large tables
     */

    public function toggleComplete() {
        $this->completed = !$this->completed;
        $this->save();
    }
}
