<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    use ApiResponser;

    public function index()
    {
        //
        $category = Category::all();
        return $this->showAll($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        $request->validated();
        $category = Category::create([
                        'categoryName' => $request->categoryName,
                        'categorySlug' => Str::slug($request->categoryName, '-'),
                    ]);
        return $this->showOne($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return $this->showOne($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        //
        $request->validate([
            'categoryName' => 'required|unique:categories,CategoryName,'.$category->id,
        ]);
        $category->categoryName = $request->categoryName;
        $category->categorySlug = Str::slug($request->categoryName, '-');
        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return $this->showOne($category);
    }
}
