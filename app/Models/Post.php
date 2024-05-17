<?php

namespace App\Models;

use App\Constants\PostConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = PostConstant::FILLABLE;
    protected $hidden = ['created_at', 'updated_at', 'user_id', 'category_id'];
    protected $with = ['category'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class);
    }
}
