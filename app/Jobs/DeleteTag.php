<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class DeleteTag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag =   $tag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!is_null($this->tag->image)){
            File::delete(storage_path('app/' . $this->tag->imagePath()));
        }

        $this->tag->delete();
    }
}
