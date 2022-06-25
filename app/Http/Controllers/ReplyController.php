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
     * The `__construct()` function is a special function that is called when an object is instantiated.
     * In this case, we are using it to call the `middleware()` function, which is a Laravel function
     * that allows us to specify which routes are protected by the JWT middleware
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    /**
     * It returns a collection of replies for a given question
     * 
     * @param \App\Models\Question  $question This is the route model binding.
     * 
     * @return \Illuminate\Http\Response A collection of replies
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }



    /**
     * We create a new reply for the question, then we check if the user who created the reply is not
     * the same as the user who created the question. If it's not the same, we notify the user who
     * created the question
     * 
     * @param \App\Http\Requests\StoreReplyRequest  $request The request object.
     * @param \App\Models\Question  $question This is the question model that we are using to create the reply.
     * @param \App\Models\Reply  $reply The reply model instance.
     * 
     * @return \Illuminate\Http\Response A new reply resource.
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
     * It returns a new instance of the ReplyResource class, passing in the  variable
     * 
     * @param \App\Models\Question  $question This is the question that the reply belongs to.
     * @param \App\Models\Reply  $reply This is the model binding that we did in the route.
     * 
     * @return \Illuminate\Http\Response A ReplyResource
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }


    /**
     * It updates the reply with the request data and returns a response with the status code of 202
     * 
     * @param \App\Http\Requests\UpdateReplyRequest  $request The request object.
     * @param \App\Models\Question  $question This is the question model that we are using to find the question that
     * the reply belongs to.
     * @param \App\Models\Reply  $reply This is the model binding that we did in the route.
     * 
     * @return \Illuminate\Http\Response The response is being returned as a string.
     */
    public function update(UpdateReplyRequest $request, Question $question, Reply $reply)
    {
        $reply->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);
    }


    /**
     * The `destroy` function deletes a reply and returns a 204 No Content response
     * 
     * @param \App\Models\Question  $question This is the question that the reply belongs to.
     * @param \App\Models\Reply  $reply This is the reply that we want to delete.
     * 
     * @return \Illuminate\Http\Response The response is returning a 204 status code, which means that the request was successful,
     * but there is no content to return.
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response(NULL, Response::HTTP_NO_CONTENT);
    }
}