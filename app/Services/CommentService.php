<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentsRepository;

class CommentService extends BaseService
{
    public $commentsRepository;
    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function addComment($request){
        try {

            $request['user_id'] = $request->user()->id;
            $comment = $this->commentsRepository->save(new Comment(),$request->all());
            return ["success" => true, "message" => 'comment added succesfully!', 'data'=> $comment];  

        } catch (\Throwable $th) {
            $error = ['Exception' => get_class($th), 'Message' => $th->getMessage(), 'File' => $th->getFile(), 'Line' => $th->getLine()];
            $this->generateLogs($error, "add-comment - Catch Exception",  "error"); //for log
            return ["success" => false, "message" => $th->getMessage() . " at line " . $th->getLine(), 'data' => null];
        }
        
    }
}