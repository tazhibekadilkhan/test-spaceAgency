<?php

namespace App\Models;

use App\Constants\CategoryConstant;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = CategoryConstant::FILLABLE;
    protected $hidden = ['created_at', 'updated_at'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
