<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use Spatie\FlareClient\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class QuestionController extends Controller
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
     * It returns a collection of QuestionResource objects, which are created from the latest questions
     * in the database
     * 
     * @return \Illuminate\Http\Response A collection of QuestionResource
     */
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }


    /**
     * It creates a new question, and returns a response with the newly created question
     * 
     * @param \App\Http\Requests\StoreQuestionRequest  $request The request object.
     * 
     * @return \Illuminate\Http\Response A new QuestionResource object.
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = auth()->user()->question()->create($request->all());
        return response(new QuestionResource($question), Response::HTTP_CREATED);
    }


    /**
     * It takes a question object and returns a question resource
     * 
     * @param \App\Models\Question  $question This is the route model binding. Laravel will automatically inject the
     * model instance that has an ID matching the corresponding value from the request URI.
     * 
     * @return \Illuminate\Http\Response A new instance of QuestionResource
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }


    /**
     * It takes an UpdateQuestionRequest object, a Question object, updates the Question object with the
     * data from the UpdateQuestionRequest object, and returns a QuestionResource object
     * 
     * @param \App\Http\Requests\UpdateQuestionRequest  $request The request object that contains the data that was sent to
     * the server.
     * @param \App\Models\Question  $question This is the model that we are updating.
     * 
     * @return \Illuminate\Http\Response A QuestionResource object.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->all());
        return response(new QuestionResource($question), Response::HTTP_ACCEPTED);
    }


    /**
     * It deletes the question and returns a 204 No Content response
     * 
     * @param \App\Models\Question  $question This is the variable that will contain the Question model instance that
     * corresponds to the ID in the route.
     * 
     * @return \Illuminate\Http\Response The question is being deleted and a 204 status code is being returned.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response(NULL, Response::HTTP_NO_CONTENT);
    }
}