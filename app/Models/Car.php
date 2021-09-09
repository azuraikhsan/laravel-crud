<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function user()
    {
        //User.php - FK user_id, refer to id (Model, FK, PK)
        return $this->belongsTo('App\Models\User');
    }
}
