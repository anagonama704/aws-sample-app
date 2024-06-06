<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(User::class);
        $users = User::query()->where('is_admin', '0')->orderBy('created_at', 'desc')->paginate(15);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize($user);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize($user);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize($user);
        $this->validate($request, [
            'name' => 'required|string',
            'birth_date' => [
                'required',
                'string',
                'date'
            ],
            'zip_code' => 'required|size:7|alpha_num|regex:/^[0-9]+$/',
            'address' => 'required|max:150',
            'tel' => 'nullable|size:11|alpha_num|regex:/^[0-9]+$/',
        ]);
        $user->update($request->all());
        return redirect(route('users.show', $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize($user);
        $user->delete();
        return redirect(route('users.index'));
    }
}
