<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart_name extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "chart_name";
}
