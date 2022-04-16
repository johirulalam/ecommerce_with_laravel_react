<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    use ApiResponser;
    public function index()
    {
        //
        $subcategory = Subcategory::all();
        return $this->showAll($subcategory);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subCategoryName' => 'required|unique:subcategories,subCategoryName',
        ]);

        $subcategory = Subcategory::create([
                            'category_id' => $request->category_id,
                            'subCategoryName' => $request->subCategoryName,
                            'subCategorySlug' => Str::slug($request->subCategoryName, '-'),
                        ]);
        return $this->showOne($subcategory);
    }


    public function show(Subcategory $subcategory)
    {
        return $this->showOne($subcategory);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'exists:categories,id',
            'subCategoryName' => 'unique:subcategories,subCategoryName,'.$subcategory->id,
        ]);
        if($request->has('category_id')) {
            $subcategory->category_id = $request->category_id;
        }
        if($request->has('category_id')) {
            $subcategory->subCategoryName = $request->subCategoryName;
            $subcategory->subCategorySlug = Str::slug($request->subCategoryName, '-');
        }
        
        $subcategory->save();
        return $this->showOne($subcategory);
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return $this->showOne($subcategory);
    }
}
