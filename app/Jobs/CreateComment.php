<?php

namespace App\Jobs;

use App\Contracts\CommentAble;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $body;
    private $parentId;
    private $author;
    private $commentAble;
    private $depth;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
                                string $body,
                                ?int $parentId,
                                User $author,
                                CommentAble $commentAble,
                                ?int $depth,
    )
    {
        $this->body = $body;
        $this->parentId = $parentId;
        $this->author = $author;
        $this->commentAble = $commentAble;
        $this->depth = $depth;
    }

    public static function fromRequest(CommentRequest $request): self
    {
        return new static(
            $request->body(),
            $request->parentId(),
            $request->author(),
            $request->commentAble(),
            $request->depth(),
        );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): Comment
    {
        // try {
            $comment = new Comment([
                'body' => $this->body ,
                'parent_id' => $this->parentId ,
                'depth' => $this->depth ,
            ]);

            $comment->authoredBY($this->author);
            $comment->to($this->commentAble);
            $comment->save();
        // } catch (\Throwable $th) {
        //     dd($th->getMessage());
        // }

        return $comment;
    }
}
