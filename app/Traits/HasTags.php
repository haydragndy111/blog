<?php
namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    public function tags(){
        return $this->tagsRelation;
    }

    public function tagsRelation(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function syncTags(array $tags)
    {
        try {
            $this->save();
            $this->tagsRelation()->sync($tags);
            $this->unsetRelation('tagsRelation');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function removeTags(){
        $this->tagsRelation()->detach();
        $this->unsetRelation('tagsRelation');
    }

}
