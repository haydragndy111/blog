<?php

namespace App\Jobs;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Services\SaveImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CreateTag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $image;
    private $description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $name, ?string $image, string $description)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
    }

    public static function fromRequest(TagRequest $request){
        return new static(
            $request->name(),
            $request->image() ,
            $request->description(),
        );
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): Tag
    {
        $tag = new Tag([
            'name'  => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            // 'slug' => 'Str::slug($this->name)'
        ]);

        // $this->saveImageService->UploadImage($this->image, $tag, Tag::TABLE);
        SaveImageService::UploadImage($this->image, $tag, TAG::TABLE);
        $tag->save();
        return $tag;
    }
}
