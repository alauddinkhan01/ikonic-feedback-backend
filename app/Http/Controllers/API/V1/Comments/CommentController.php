<?php

namespace App\Http\Controllers\API\V1\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Comments\CommentsRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function addComment(CommentsRequest $request){
       $comment = $this->commentService->addComment($request);
       return response()->json($comment);
    }
}
