<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;

    public function cities() {
        return $this->hasMany('\App\City');
    }

    public function users() {
        return $this->hasMany('\App\User');
    }
}
