<?php


namespace App\Http\Controllers;


use App\Events\UserRegisteredEvent;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){

        $this->authorize('view-any', User::class);

        $users = User::get();

        return view('users.index', compact('users'));
    }

    public function create(){
        $this->authorize('create', User::class);

        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request){
        $this->authorize('create', User::class);

        $data = $request->validated();
        $data['role_id'] = $data['role'];
        $tempPassword = Str::random(8);
        $data['password'] = Hash::make($tempPassword);
        $user = User::create($data);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $user->addMediaFromRequest('photo')->toMediaCollection('users');
        }

        event(new UserRegisteredEvent($user, $tempPassword));

        return redirect()->route('users.index')->with(['success' => 'User created successfully']);
    }

    public function edit(Request $request, User $user){
        $this->authorize('update', [User::class, $user]);

        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user){
        $this->authorize('update', [User::class, $user]);

        $data = $request->validated();
        /*if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }*/
        $user->update($data);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $user->clearMediaCollection('users');
            $user->addMediaFromRequest('photo')->toMediaCollection('users');
        }

        return redirect()->route('users.index')->with(['success' => 'User updated successfully']);
    }

    public function destroy(User $user){
        $this->authorize('delete', [User::class, $user]);

        $user->clearMediaCollection('users');
        $user->delete();
        return redirect()->route('users.index')->with(['success' => 'User deleted successfully']);
    }

    public function impersonateUser(Request $request, User $user){
        auth()->user()->impersonate($user);
        return redirect()->route('home');
    }

    public function leaveImpersonate(){
        auth()->user()->leaveImpersonation();
        return redirect()->route('home');
    }
}
