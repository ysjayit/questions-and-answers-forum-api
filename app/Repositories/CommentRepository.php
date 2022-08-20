<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;
use App\Traits\ResponseAPI;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Resources\Comment as CommentResource;
use Log;
use Auth;

class CommentRepository implements CommentRepositoryInterface {

    use ResponseAPI;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new(CommentCreateRequest $request, $id)
    {
        
        try {
            
            $inputData = $request->all();
            $inputData['post_id'] = $id;
            $inputData['user_id'] = Auth::user()->id;
            $inputData['date'] = now();
            $inputData['comment'] = $request->comment;
            $comment = Comment::create($inputData);

            return $this->sendResponse(new CommentResource($comment), 'Comment created successfully.');
            
        } catch(\Exception $e) {
            Log::error('Create Comment Error => '.$e->getMessage());
            return $this->sendError('Error in Create Comment', ['error' => $e->getCode()]);
        }

    }




}