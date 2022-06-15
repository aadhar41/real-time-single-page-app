<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\Reply;
use App\Http\Requests\StorelikeRequest;
use App\Http\Requests\UpdatelikeRequest;

class LikeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function likeIt(Reply $reply)
    {
        $reply->like()->create([
            'user_id' => auth()->id()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unlikeIt(Reply $reply)
    {
        $reply->like()->where(['user_id' => auth()->id()])->first()->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelikeRequest  $request
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelikeRequest $request, like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(like $like)
    {
        //
    }
}