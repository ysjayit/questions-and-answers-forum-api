<?php

namespace App\Interfaces;

use App\Http\Requests\CommentCreateRequest;

interface CommentRepositoryInterface 
{
    public function new(CommentCreateRequest $request, $id);
}