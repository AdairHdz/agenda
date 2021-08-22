<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Contact extends Model
{
    use HasFactory;
    protected $attributes = [
        "middle_name" => "",
        "email_address" => ""
    ];

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
