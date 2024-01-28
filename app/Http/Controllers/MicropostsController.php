<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micropost;

class MicropostsController extends Controller
{
     public function index()
    {
    $data = [];
    if (\Auth::check()) {
        $user = \Auth::user();
         $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        return view('dashboard', $data);
    }
    
    public function store(Request $request)
    {
          $request->validate([
            'content' => 'required|max:255',
        ]);
        
         $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
         return back();
    }
    public function destroy($id)
    {
        $micropost = \App\Models\Micropost::findOrFail($id);
        
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
            return back()
                ->with('success','Delete Successful');
        }
        return back()
            ->with('Delete Failed');
    }
}



