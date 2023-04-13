<?php
namespace App\Traits;

use App\Models\User;
use App\Contracts\CommentAble;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasReplies
{

    public function repliesRelation(): HasMany{
        return $this->hasMany(self::class, 'parent_id');
    }

    public function replies()
    {
        return $this->repliesRelation;
    }

    public function depth()
    {
        return $this->depth >= config('settings.comments.max') -1;
    }

    public function maximumReplies(): bool
    {
        return $this->repliesRelation()->count() >= config('settings.replies.max') ;
    }

}
