<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserInterface;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    } // end of construct

    public function index(Request $request)
    {
        return $this->userInterface->index($request);
    } // end of index

    public function create()
    {
        return $this->userInterface->create();
    }// end of create

    public function store(UserRequest $userRequest)
    {
        return $this->userInterface->store($userRequest);
    } // end of store
    public function edit(User $user)
    {
        return $this->userInterface->edit($user);
    }// end of edit
    public function update(UserRequest $userRequest, User $user)
    {
        return $this->userInterface->update($userRequest, $user);
    }// end of update
    public function destroy(User $user)
    {
        return $this->userInterface->destroy($user);
    }
}
