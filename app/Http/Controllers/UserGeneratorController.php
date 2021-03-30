<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserGeneratorController extends Controller
{
    //Display all user
    public function showUsers(){
        $users = User::all();
        return view('users', compact('users'));
    }

    //delete user from database and send message to view
    public function destroy($id){
        try {
            User::where('id', $id)->delete();
        } catch (QueryException $exception) {
            return redirect()->back()->with('message', 'Deleting User Failed!');
        }

        return redirect()->back()->with('message', 'User Successfully Deleted!');
    }
}
