<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todays_result extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "todays_result";
}
