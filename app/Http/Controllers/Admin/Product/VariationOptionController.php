<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\ApiController;
use App\Models\VariationOption;
use Illuminate\Http\Request;

class VariationOptionController extends ApiController
{

    public function index()
    {
        //
        $variationOption = VariationOption::all();
        return $this->showAll($variationOption);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $request->validate([
            'variation_id' => 'required|integer|exists:variations,id',
            'variationOptionName' => 'required|unique:variation_options,variationOptionName',
        ]);

        $variationOption = VariationOption::create([
                            'variation_id' => $request->variation_id,
                            'variationOptionName' => $request->variationOptionName,
                        ]);
        return $this->showOne($variationOption);
    }


    public function show(VariationOption $variationOption)
    {
        return $this->showOne($variationOption);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, VariationOption $variationOption)
    {
        $request->validate([
            'variation_id' => 'required|integer|exists:variations,id',
            'variationOptionName' => 'required|unique:variation_options,variationOptionName,'.$variationOption->id,
        ]);
        $variationOption->variationOptionName = $request->variationOptionName;
        $variationOption->variation_id = $request->variation_id;
        $variationOption->save();

        return $this->showOne($variationOption);
    }


    public function destroy(VariationOption $variationOption)
    {
        $variationOption->delete();
        return $this->showOne($variationOption);
    }
}
