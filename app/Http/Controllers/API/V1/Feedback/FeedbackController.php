<?php

namespace App\Http\Controllers\API\V1\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Feedback\FeedbackRequest;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public $feedbackService;
    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function addFeedback(FeedbackRequest $request){

        $data = $this->feedbackService->addFeedback($request);
        return response()->json($data);

    }

    public function getAllFeedback(){
        $data = $this->feedbackService->getAllFeedback();
        return response()->json($data);
    }

    public function getFeedback($id){
        $data = $this->feedbackService->getFeedback($id);
        return response()->json($data);
    }
}
