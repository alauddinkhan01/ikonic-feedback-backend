<?php

namespace App\Services;

use App\Models\Feedback;
use App\Repositories\FeedbackRepository;

class FeedbackService extends BaseService
{
    public $feedbackRepository;
    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function addFeedback($request){

        try {

            $request['user_id'] = $request->user()->id;
            $feedback = $this->feedbackRepository->save(new Feedback(),$request->all());
            return ["success" => true, "message" => 'Feedback added successfully', 'data'=> $feedback];

        } catch (\Throwable $th) {
            $error = ['Exception' => get_class($th), 'Message' => $th->getMessage(), 'File' => $th->getFile(), 'Line' => $th->getLine()];
            $this->generateLogs($error, "add-feedback - Catch Exception",  "error"); //for log
            return ["success" => false, "message" => $th->getMessage() . " at line " . $th->getLine(), 'data' => null];
        }

    }

    public function getAllFeedback(){

        try {
            $allfeedback = $this->feedbackRepository->getPaginated(new Feedback());
            return ["success" => true, "message" => 'All Feedback', 'data'=> $allfeedback];

        } catch (\Throwable $th) {
            $error = ['Exception' => get_class($th), 'Message' => $th->getMessage(), 'File' => $th->getFile(), 'Line' => $th->getLine()];
            $this->generateLogs($error, "get-all-feedback - Catch Exception",  "error"); //for log
            return ["success" => false, "message" => $th->getMessage() . " at line " . $th->getLine(), 'data' => null];
        }

    }

    public function getFeedback($id){

        try {
            $feedback = $this->feedbackRepository->getFeedback($id);
            return ["success" => true, "message" => 'Get Feedback', 'data'=> $feedback];

        } catch (\Throwable $th) {
            $error = ['Exception' => get_class($th), 'Message' => $th->getMessage(), 'File' => $th->getFile(), 'Line' => $th->getLine()];
            $this->generateLogs($error, "get-all-feedback - Catch Exception",  "error"); //for log
            return ["success" => false, "message" => $th->getMessage() . " at line " . $th->getLine(), 'data' => null];
        }

    }

}
