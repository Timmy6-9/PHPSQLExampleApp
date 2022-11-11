<?php
namespace App\Http\Controllers;

// Client controller, exists for client actions (users changing their own tables)

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Get user object from the Users table
function getUser($user){
    $fullUser = DB::table('Users')->where('Username', $user)->first();
    return $fullUser;
}

class ClientActionController extends Controller{

    // Takes input and adds it to the user's table as a new row
    public function newClient(Request $req){

        $userObj = getUser($req->session()->get('un'));

        DB::table($userObj->Organization)->insert([
            'CustomerName' => $req->input('companyName'),
            'CustomerEmail'=> $req->input('emailAddress'),
            'CustomerAddress'=> $req->input('companyAddress'),
            'MainContactName'=> $req->input('contactName'),
            'MainContactPhone'=> $req->input('phoneNumber')
        ]);

        return redirect()->route('login')->with('redirectMsg', 'Client Added Successfully');
    }

    // Finds the client the user currently has selected and returns the edit client view with the correct client
    public function findEditClient(Request $req){

        $userObj = getUser($req->session()->get('un'));

        $editRow = DB::table($userObj->Organization)->where('id', $req->input('clientID'))->first();

        return view('userClients.editClient', ['clientToEdit' => $editRow]);
    }

    // Applies changes to the client/row using an update statement
    public function editClient(Request $req){
        
        $userObj = getUser($req->session()->get('un'));

        DB::table($userObj->Organization)
            ->where('id', $req->input('companyID'))
            ->update(['CustomerName' => $req->input('companyName'), 'MainContactName' => $req->input('contactName'), 'MainContactPhone' => $req->input('phoneNumber'), 'CustomerEmail' => $req->input('emailAddress'), 'CustomerAddress' => $req->input('companyAddress')]);

        return redirect()->route('login')->with('redirectMsg', 'Client Updated Successfully');
    }

    // Finds the selected client for deletion and returns a view asking the user to confirm deletion
    public function findDeleteClient(Request $req){

        $userObj = getUser($req->session()->get('un'));

        $deleteRow = DB::table($userObj->Organization)->where('id', $req->input('clientID'))->first();

        return view('userClients.confirmDeleteClient', ['clientToDelete' => $deleteRow]);
    }

    // Confirms deletion of selected client/row
    public function confirmDelete(Request $req){

        $userObj = getUser($req->session()->get('un'));

        DB::table($userObj->Organization)
            ->where('id', $req->input('companyID'))
            ->delete();

        return redirect()->route('login')->with('redirectMsg', 'Client Deleted Successfully');
    }
}