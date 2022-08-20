<?php

namespace App\Interfaces;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostSearchRequest;
use App\Http\Requests\PostUpdateRequest;

interface PostRepositoryInterface 
{
    public function getAll();
    public function getByUser(PostRequest $request);
    public function getByStatus($status);
    public function getSearch(PostSearchRequest $request);
    public function new(PostCreateRequest $request);
    public function get($id);
    public function update(PostUpdateRequest $request, $id);
    public function delete($id);
}