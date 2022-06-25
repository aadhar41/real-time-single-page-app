<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }


    /**
     * We create a new category, assign the name and slug, and save it
     * 
     * @param \App\Http\Requests\StoreCategoryRequest  $request The request object.
     * 
     * @return A new CategoryResource object.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Category::create($request->all());
        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->save();
        return response(new CategoryResource($category), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    /**
     * We are updating the category with the name and slug from the request
     * 
     * @param \App\Http\Requests\UpdateCategoryRequest  $request The request object that contains the data that was sent to
     * the server.
     * @param \App\Models\Category  $category This is the model that we are updating.
     * 
     * @return \Illuminate\Http\Response A response with the updated category and a status code of 202.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update(
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]
        );

        return response(new CategoryResource($category), Response::HTTP_ACCEPTED);
    }


    /**
     * It deletes the category and returns a 204 No Content response
     * 
     * @param \App\Models\Category  $category The model that we want to use for the resource controller.
     * 
     * @return \Illuminate\Http\Response A 204 No Content response.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(NULL, Response::HTTP_NO_CONTENT);
    }
}