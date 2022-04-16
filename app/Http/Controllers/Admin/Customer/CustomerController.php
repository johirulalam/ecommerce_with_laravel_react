<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends ApiController
{

    public function index()
    {
        //
        $user = User::where('admin', 0)->get();
        return $this->showAll($user);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //
        return $this->showOne($user);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(User $user)
    {
        //
        $user->delete();
        return $this->showOne($user);
    }
}
