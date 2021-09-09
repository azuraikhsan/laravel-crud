<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        //User.php - FK user_id, refer to id (Model, FK, PK)
        return $this->belongsTo('App\Models\User');
    }

    //declaration for custom FK
    //public function user()
    //{
        //User.php - FK pengguna_id
    //    return $this->belongsTo('App\Models\User', 'pengguna_id');
    //}
}
