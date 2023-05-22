<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function index($type)
    {
        $users = User::where('type', $type)->get();

        return view('admin.index', compact('users','type'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create()

    {
        $user = new User();
        return view('admin.register',compact('user'));

    }

    protected function register(Request $request){
        $v = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $create=User::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        Alert::success('AGREGADO', 'Se agregó correctamente.');
        return redirect()->route('admin.users.index',$request['type']);

    }

    public function edit($user,$id)
    {
        $user = User::find($id);

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // request()->validate(User::$rules);
        $v = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        // $user->update($request->all());
        $user->name = $request['name'];
        $user->password = Hash::make($request['password']);
        $user->update();

        Alert::success('ACTUALIZADO', 'Se actualizó correctamente.');
        return redirect()->route('admin.users.index',$request['type']);

        // return redirect()->route('admin.users.index')
        //     ->with('success', 'User updated successfully');

    }

    public function destroy($id,$type)
    {
        $user = User::find($id)->delete();

        Alert::success('ELIMINADO', 'Se eliminó correctamente.');
        return redirect()->route('admin.users.index',$type);
    }

   
}
