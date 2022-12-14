<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
       
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {

    
        $data['users'] = User::orderBy('id','desc')->paginate(1);
        /*Récupère toutes les tables de categories
           select * from categories*/
        $categories = DB::table('categories')->get();
        dump($categories);

        /*Même chose where= plus de précision label=livre récupère 
         les premiers résultats*/

        $livre = DB::table('categories')->where('label', 'livre')->first();
        dump($livre);

        /*Même chose récupère le model Category 
         les 5 premiers résultats*/
        $data['categories'] = Category::orderBy('id','desc')->paginate(5);

        //Récupère les categories par id ici l'id est 1
        $cat1 = DB::table('categories')->find(1);
        dump($cat1);
        $users = DB::table('users')->count();
        dump($users);

        dump($data);

        //dd= dump + die
        dd($data);

        return view('users.index', $data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('users.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

            return redirect()->route('users.index')
        ->with('success','User has been created successfully.');
    }
 
    /**
     * Show the profile for the given user.
     *
     * @param  User  $user
     * @return Response
     */
    public function show(User $user)
    {   
        return view('users.show', ['user' => $user]);
    }
}