<?php

namespace App\Models;

use App\Constants\CommentConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = CommentConstant::FILLABLE;
    protected $hidden = ['updated_at'];
    protected $with = ['user'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
