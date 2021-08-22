<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    const PHONE_HOME = 0;
    const PHONE_WORK = 1;
    const PHONE_MOBILE = 2;

    protected $fillable = ["phone_number_type", "number"];
    use HasFactory;
}
