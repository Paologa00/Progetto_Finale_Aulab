<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\CareerRequestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function careersSubmit(Request $request){
        $request->validate([
            'role' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $user = Auth::user();
        $role = $request->role;
        $email = $request->email;
        $message = $request->message;

        Mail::to('admin@theaulabpost.it')->send(new CareerRequestMail(compact('role', 'email', 'message')));

        switch ($role) {
            case 'admin':
                $user->is_admin = NULL;
                break;
            
            case 'revisor':
                $user->is_revisor = NULL;
                break;

            case 'writer':
                $user->is_writer = NULL;
                break;
        }

        $user->update();

        return redirect(route('homepage'))->with('message', 'Grazie per averci contattato!');
        
    }

    public function __construct(){
        $this->middleware('auth')->except('homepage', 'storia', 'chisiamo');
    }
          

    public  function homepage() {
        $articles = Article::where('is_accepted', true)->orderby('created_at', 'desc')->take(3)->get();
        return view('welcome', compact('articles'));
    }

    public function careers() {
        return view('careers');
    }

    public function storia() {
        return view('storia');
    }

    public function chisiamo() {
        return view('chisiamo');
    }
}
