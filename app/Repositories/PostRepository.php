<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use App\Traits\ResponseAPI;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostSearchRequest;
use App\Http\Resources\Post as PostResource;
use Log;
use Auth;

class PostRepository implements PostRepositoryInterface {

    use ResponseAPI;

    /**
     * Register API
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll() {

        try {
            
            $posts = Post::all();

            return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
            
        } catch(\Exception $e) {
            Log::error('Get All Posts Error => '.$e->getMessage());
            return $this->sendError('Error in Get All Posts', ['error' => $e->getCode()]);
        }        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new(PostCreateRequest $request)
    {
        
        try {
            
            $inputData = $request->all();
            $inputData['user_id'] = Auth::user()->id;
            $inputData['date'] = now();
            $inputData['status'] = (Auth::user()->role == 'user') ? 'draft' : 'approved';
            $post = Post::create($inputData);

            return $this->sendResponse(new PostResource($post), 'Post created successfully.');
            
        } catch(\Exception $e) {
            Log::error('Create Post Error => '.$e->getMessage());
            return $this->sendError('Error in Create Post', ['error' => $e->getCode()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        
        try {
            
            $post = Post::find($id);
  
            if (is_null($post)) {
                return $this->sendError('Post not found.');
            }
    
            return $this->sendResponse(new PostResource($post), 'Post retrieved successfully.');
            
        } catch(\Exception $e) {
            Log::error('Get Post Error => '.$e->getMessage());
            return $this->sendError('Error in Get Post', ['error' => $e->getCode()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByUser(PostRequest $request)
    {
        
        try {
            
            $userId = Auth::user()->id;

            $posts = Post::where('user_id', $userId)->orderBy('id', 'desc')->get();
    
            return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
            
        } catch(\Exception $e) {
            Log::error('Get User Post Error => '.$e->getMessage());
            return $this->sendError('Error in Get User Post', ['error' => $e->getCode()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByStatus($status='draft')
    {
        
        try {
            
            $posts = Post::where('status', $status)->orderBy('id', 'desc')->get();
    
            return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
            
        } catch(\Exception $e) {
            Log::error('Get Posts By Status Error => '.$e->getMessage());
            return $this->sendError('Error in Get Posts By Status', ['error' => $e->getCode()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        
        try {
            
            $post = Post::find($id);
            if ($request->filled('title')) {
                $post->title = $request->title;
            }
            if ($request->filled('content')) {
                $post->content = $request->content;
            }
            if ($request->filled('status')) {
                $post->status = $request->status;
            }
            $post->save();

            return $this->sendResponse(new PostResource($post), 'Post Updated successfully.');
            
        } catch(\Exception $e) {
            Log::error('Update Post Error => '.$e->getMessage());
            return $this->sendError('Error in Update Post', ['error' => $e->getCode()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSearch(PostSearchRequest $request)
    {
        
        try {

            $posts = Post::where('status', 'approved')
                    ->where('title', 'like', '%' . $request->term . '%')
                    ->orWhereHas('user', function($q) use($request) {
                        $q->where('name', 'like', '%' . $request->term . '%');
                    })->get();
    
            return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
            
        } catch(\Exception $e) {
            Log::error('Get Posts By Status Error => '.$e->getMessage());
            return $this->sendError('Error in Get Posts By Status', ['error' => $e->getCode()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
        try {
            
            $post = Post::find($id);

            if (is_null($post)) {
                return $this->sendError('Post not found.');
            }

            $post->delete();

            return $this->sendResponse([], 'Post deleted successfully.');
            
        } catch(\Exception $e) {
            Log::error('Post Delete Error => '.$e->getMessage());
            return $this->sendError('Error in Post Delete', ['error' => $e->getCode()]);
        }

    }




}