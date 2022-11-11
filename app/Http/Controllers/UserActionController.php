<?php
namespace App\Http\Controllers;

/*
    User controller, for handling user requests to do with inputting and accessing user (not customer) data.
    Inherits default controller class (required for controllers).
*/ 

use App\Models\UserTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

// This exists to create the user object, I probably didn't need it in hindsight
class userObj{
    public $username;
    public $password;
    public $confPass;
    public $email;
    public $orgName;
}

class UserActionController extends Controller{

    // Method for registering new user. Hashes the password then saves the username, password and email for the user as well as creating a new table with the same name as their organization.
    public function registerUser(Request $req){

        // Validate registration request
        $validatedInput = $req->validate([
            'user' => 'required|unique:Users,Username|alpha_num|min:5|max:256',
            'pass' => 'required|min:6|max:256',
            'confPass' => 'required|min:6|max:256',
            'email' => 'required|email:rfc,dns|max:256',
            'orgName' => 'required|unique:Users,Organization|min:5|max:256'
        ]);

        // Assign validated input to object
        $user = new userObj();
        $user->username = $validatedInput['user'];
        $user->password = $validatedInput['pass'];
        $user->confPass = $validatedInput["confPass"];
        $user->email = $validatedInput["email"];
        $user->orgName = $validatedInput["orgName"];

        // Redirect back to register page if no input in any one of the fields (redundant now with input validation)
        foreach ($user as $userProp) {
            if(empty($userProp)){
                return redirect('/newUser')->with('redirectMsg', "Please make sure to fill in all of the account creation fields");
            }
        }

        // Hash Password
        $user->password = Hash::make($user->password);

        // Check hashed password matches the password confirmation (also sort of redundant now except as a failsafe)
        if (Hash::check($user->confPass, $user->password)){

            // Remove any quotes and spaces from the company name, this is done so that the name can be used to load the correct table for the user. Could add a "real org name" field if I needed to display the properly formatted company name anywhere.
            // I'm also not sure if having one organization name and using addslashes() would be better
            $user->orgName = str_replace(array('"',"'",' '), '', $user->orgName);

            // Save User details to 'Users' table
            $userTable = new UserTable;
            $userTable->Username = $user->username;
            $userTable->Password = $user->password;
            $userTable->EmailAddress = $user->email;
            $userTable->Organization = $user->orgName;
            $userTable->save();

            // Create Client Table for User with their company name as the table name
            Schema::create($user->orgName, function (Blueprint $table) {
                $table->id();
                $table->string('CustomerName');
                $table->string('CustomerEmail');
                $table->string('CustomerAddress');
                $table->string('MainContactName');
                $table->string('MainContactPhone');
            });

            // Regen/Flush Session, just in case
            $req->session()->flush();
            $req->session()->regenerate();
            
            // Redirect to the login page
            return redirect('/')->with('redirectMsg', "Thank you for creating an account, please sign in to start listing clients");
        }   
        else {
            // Redirect back to register page if passwords don't match
            return redirect('/newUser')->with('redirectMsg', "Please make sure both password fields match");
        }
    }

    // Method for confirming login details. Accesses 'Users' table and confirms the given username/password combo is the same as the saved username/hashed password. Also used for redirects in active sessions.
    public function login(Request $req){

        $userInput = new userObj();

        if(!empty($req->input('user'))){

            // Validate input fields
            $validatedInput = $req->validate([
                'user' => 'required|alpha_num|min:5|max:256',
                'pass' => 'required|min:6|max:256'
            ]);

            // Assign validated input to object
            $userInput->username = $validatedInput['user'];
            $userInput->password = $validatedInput['pass'];

            // Flush session in case of multiple users on one machine | Regenerate Session in case of session fixation attacks
            $req->session()->flush();
            $req->session()->regenerate();
            
        }
        else{
            $userInput->username = $req->session()->get('un');
            $userInput->password = $req->session()->get('pw');
        }

        // Check username against saved users, get results where username matches (should only be one as usernames have to be unique both in the SQL table and per validation rules)
        $accArr = UserTable::where('Username', $userInput->username)
            ->get();
            
        // Redirect back if username is incorrect (returns no result)
        if (empty($accArr[0])){
            return redirect('/')->with('redirectMsg', "Please ensure your username and password match an account registered with us");
        }

        $user = $accArr[0];

        // Check password against saved hashed password, redirect to their client list if correct, otherwise redirect back to login page
        if (Hash::check($userInput->password, $user->Password)){

            // Create a string to use for the sql query (for the table name). Can't use "? + variable" method like in the laravel docs as it gives a sql error despite the query it creates being syntactically correct
            $query = 'select * from ' . $user->Organization;

            // Load user's client table to be shared with the view
            $userTable = DB::select($query);

            // Add login details to session, session lasts 60 minutes and exists on the server only, storing the password here shouldn't be anymore insecure than storing it in the database (at least in theory, maybe)
            if(empty($req->session()->get('un'))){
                $req->session()->put('un', $userInput->username);
                $req->session()->put('pw', $userInput->password);
            }

            // Send user to their client table with loaded data
            return view('userClients.showUserClients', ['clientDetails' => $userTable]);
        }
        else{
            // Redirect to login page with 
            return redirect('/')->with('redirectMsg', "Please ensure your username and password match an account registered with us");
        }
    }
}

?>