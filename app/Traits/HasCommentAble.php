<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Contracts\CommentAble;

trait HasCommentAble
{

    public function commentAbleRelation(): MorphTo{
        return $this->morphTo('commentAbleRelation', 'commentable_type', 'commentable_id');
    }

    public function commentAble(): Commentable
    {
        return $this->commentAbleRelation;
    }

    public function to(CommentAble $commentAble)
    {
        return $this->commentAbleRelation()->associate($commentAble);
    }

}
