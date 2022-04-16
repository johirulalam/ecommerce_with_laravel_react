<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variation;
use App\Traits\ApiResponser;

class VariationController extends Controller
{
    use ApiResponser;

    public function index()
    {
        //
        $variation = Variation::all();
        return $this->showAll($variation);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'variationName' => 'required|unique:variations,variationName',
        ]);

        $variation = Variation::create([
                        'variationName' => $request->variationName,
                    ]);
        return $this->showOne($variation);
    }


    public function show(Variation $variation)
    {
        //
        return $this->showOne($variation);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request,Variation $variation)
    {
        //
        $request->validate([
            'variationName' => 'required|unique:variations,variationName,'.$variation->id,
        ]);

        $variation->variationName = $request->variationName;
        $variation->save();

        return $this->showOne($variation);
    }


    public function destroy(Variation $variation)
    {
        //
        $variation->delete();
        return $this->showOne($variation);
    }
}
