<?php
namespace App\http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        $userInfo = User::where('email','=',$request->email)->first();
        if(!$userInfo)
        {
            return back()->with('fail','We do not recognize your email address');
        }
        else
        {
            // Check password
            if(Hash::check($request->password,$userInfo->password))
            {
                
                $request->session()->put('LoggedUser',$userInfo->id);
                
                return redirect('area');
            }
            else
            {
                return back()->with('fail','Incorrect password');
            }
        }
    }

    function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
            'cpassword' => 'required|min:5|max:12|same:password'
        ],

        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'cpassword.required' => 'Confirm password is required',
        ]);
        
        //create a email to send it to the user witha  token to verify the email

        // Insert data into database
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();


        //redirected
        if($save)   
        {
            return back()->with('success','New user has been successfuly created');
        }
        else
        {
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    function logout()
    {
        if(session()->has('LoggedUser'))
        {
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}

// Path: app\Providers\RouteServiceProvider.php
// Compare this snippet from routes\web.php:
// <?php
// 
// use Illuminate\Support\Facades\Route;
// use App\http\Controllers\LoginController;
// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
//