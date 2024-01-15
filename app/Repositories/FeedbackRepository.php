<?php

namespace App\Repositories;

use App\Models\Feedback;
use App\Repositories\BaseRepository as RepositoriesBaseRepository;

class FeedbackRepository extends RepositoriesBaseRepository
{

    public function getFeedback($id){
        return Feedback::find($id)->load('comments','comments.user');
    }

}
