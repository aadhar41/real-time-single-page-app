<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Question;
use App\Http\Resources\ReplyResource;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Notifications\NewReplyNotification;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Question  $question
     * @param  \App\Models\Reply  $reply
     * @param  \App\Http\Requests\StoreReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyRequest $request, Question $question, Reply $reply)
    {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        if ($reply->user_id !== $question->user_id) {
            $user->notify(new NewReplyNotification($reply));
        }
        return response(["reply" => new ReplyResource($reply)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Question  $question
     * @param  \App\Http\Requests\UpdateReplyRequest  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyRequest $request, Question $question, Reply $reply)
    {
        $reply->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response(NULL, Response::HTTP_NO_CONTENT);
    }
}