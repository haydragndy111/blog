<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
// Traits
use App\Traits\HasAuthor;
use App\Traits\ModelHelpers;
use App\Traits\HasCommentAble;
use App\Traits\HasReplies;
// Contracts
use App\Contracts\CommentAble;

class Comment extends Model
{
    use HasFactory;
    use HasAuthor;
    use ModelHelpers;
    use HasCommentAble;
    use HasReplies;

    const TABLE = 'comments';

    protected $table = self::TABLE;

    protected $fillable = [
        'body',
        'parent_id',
        'depth',
    ];

    protected $with = [
        'authorRelation',
        'repliesRelation'
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function parentId(): string
    {
        return $this->parent_id;
    }

    public function excerpt(int $limit = 100): string
    {
        return Str::limit(strip_tags($this->body()), $limit);
    }

    public function commentAbleRelation(): MorphTo{
        return $this->morphTo('commnetAbleRelation', 'commentable_type', 'commentable_id');
    }

    public function commentAble(): commentAble
    {
        return $this->commentAbleRelation;
    }

    public function to(CommentAble $commentAble)
    {
        return $this->commentAbleRelation()->associate($commentAble);
    }

}
