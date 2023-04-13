<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Traits\HasTags;
use App\Casts\TitleCast;
use App\Contracts\CommentAble;
use App\Traits\HasAuthor;
use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model implements CommentAble
{

    use HasFactory;
    use HasAuthor;
    use HasTags;
    use HasComments;

    const TABLE = 'posts';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'image',
        'published_at',
        'type',
        'photo_credit_text',
        'photo_credit_link',
        'author_id',
        'is_commentable',
    ];

    // Eager Load the relationship
    // Post::with('tags')->
    // authorRelation is function in {{ HasAuthor }} trait
    protected $with = [
        'authorRelation',
        'commentsRelation',
        'tagsRelation'
    ];

    // when get the data about time and days,
    // we want it to be formatted as carbon
    // castsis changing the format of variable
    // like casting to integer
    protected $casts = [
        'published_at' => 'datetime',
        'title' => TitleCast::class,
        'is_commentable' => 'boolean',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function isPremium(){
        return $this->type() == 'premium';
    }

    public function excerpt(int $limit = 250): string
    {
        return Str::limit(strip_tags($this->body()), $limit);
    }

    public function image(): string
    {
        return $this->image;
    }

    public function publishedAt(): string
    {
        return $this->published_at;
    }

    public function publishedAtDate(): string
    {
        return $this->published_at->format('d F Y');
    }

    public function photoCreditText(): ?string
    {
        return $this->photo_credit_text;
    }

    public function photoCreditLink(): ?string
    {
        return $this->photo_credit_link;
    }

    public function delete()
    {
        $this->removeTags();
        parent::delete();
    }

    public function readTime(){
        $minutes = round(str_word_count(strip_tags($this->body())) / 200 );

        return $minutes == 0 ? 1 : $minutes;
    }

    public function isCommentable(): string
    {
        return $this->is_commentable;
    }

    public function commentAbleTitle(): string
    {
        return $this->title();
    }

    public function scopeLoadLatest(Builder $query, $count = 4)
    {
        return $query->published()
            ->inRandomOrder()
            ->paginate($count);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', new \DateTime());
    }

    public function scopeForTag(Builder $query, string $tag): Builder
    {
        return $query->published()
                    ->whereHas('tagsRelation', function ($query) use ($tag) {
                            $query->where('tags.slug', $tag);
                    });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
