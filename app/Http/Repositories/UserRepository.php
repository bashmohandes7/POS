<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Image;


class UserRepository implements UserInterface
{

    public function index($request)
    {
        $users = User::whereRoleIs('admin')->whenSearch($request->search)->latest()->paginate(5);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
       return view('dashboard.users.create');
    }

    public function store($request)
    {
        $request_data = $request->except(['password_confirmation', 'permissions', 'image']);

        if($request->image){
           Image::make($request->image)
               ->resize(300, null, function ($constraint) {
                   $constraint->aspectRatio();
               })->save(public_path('uploads/user_images/' . $request->image->hashName()));
        } // end of if

        $request_data['image'] = $request->image->hashName();

        $user = User::create($request_data);

        // attach admin role to the user
        $user->attachRole('admin');
         //sync all permissions to the user
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return to_route('dashboard.users.index');
    }// end of store

    public function edit($user)
    {
        return view('dashboard.users.edit', compact('user'));
    }// end of edit


    public function update($request, $user)
    {
        $request_data = $request->except(['password_confirmation', 'permissions', 'image']);

        if ($request->image) {

            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

            }//end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of external if

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));
        return to_route('dashboard.users.index');

    }// end of update
    public function destroy($user)
    {
        if ($user->image != 'default.png') {

        Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

    }//end of if
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return to_route('dashboard.users.index');
    }// end of delete

}
