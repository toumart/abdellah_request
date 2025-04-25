<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;


class UserController extends Controller
{
    public function index()
    {
        return view('welcome'); // NOT 'welcome'
    }
    

   

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required|date',
        ]);
    
        User::create($request->only('name', 'email', 'phone', 'dob'));
    
        return redirect('/')->with('success', 'User registered successfully!');
    }
    


    public function search(Request $request)
{
    $search = $request->query('query'); // ✅ this is correct

    $user = User::where('email', $search)
                ->orWhere('name', $search)
                ->first();

    if ($user) {
        return redirect('/')->with('result', $user);
    } else {
        return redirect('/')->with('not_found', 'User not found or not registered');
    }
}
public function liveSearch(Request $request)
{
    $query = $request->get('query');

    $results = User::where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->limit(5)
                ->get(['name', 'email', 'phone', 'dob']);

    return response()->json($results);
}



public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimetypes:text/plain,text/csv,application/csv,application/vnd.ms-excel,application/octet-stream'
    ]);
    
    


    Excel::import(new UsersImport, $request->file('file'));

    return redirect('/')->with('success', ' ✅ Users imported successfully!');

    
}


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}