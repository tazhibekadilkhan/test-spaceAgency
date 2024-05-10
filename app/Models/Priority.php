<?php

namespace App\Models;

use App\Constants\PriorityConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;
    protected $fillable = PriorityConstant::FILLABLE;
    protected $hidden = ['created_at', 'updated_at'];
}
