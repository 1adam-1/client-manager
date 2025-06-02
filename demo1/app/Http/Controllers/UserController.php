<?php
namespace App\Http\Controllers;
use App\Models\utilisateurs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function showR(){
        return view('pages.auth.register');
    }

    public function create(Request $request){
        $request->validate([
            'username' => 'required|unique:utilisateurs',
            'email' => 'required|email|unique:utilisateurs',
            'password' => 'required|min:8|confirmed',
            'image' => 'required|image',
        ]);

        $utilisateur = new utilisateurs();
        $utilisateur->username = $request->username;
        $utilisateur->email = $request->email;
        $utilisateur->password = Hash::make($request->password);
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $fileName, 'public');
        $utilisateur->image = '/storage/' . $path;
        $utilisateur->save();

        return redirect()->route('register')->with('success', 'Registration successful!');
    }





    public function showLogin(){
    return view('pages.auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){

            Session::flush();
            Auth::logout();
            return to_route('showL')->with('success', 'Logout successful!');
    }

    public function showEdit($id){
        $user=utilisateurs::find($id);
        return view('pages.auth.edit',compact('user'));
    }

   // Method to handle the update form submission
public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
    ]);

    // Find the user record
    $user = utilisateurs::findOrFail($id);

    // Update user data
    $user->username = $request->username;
    $user->email = $request->email;

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Handle profile picture upload if provided
    if ($request->hasFile('image')) {
        // Store the uploaded file in a directory and update the user's image path
        $imagePath = $request->file('image')->store('profile-images', 'public');
        $user->image = $imagePath;
    }

    // Save the updated user record
    $user->save();

    // Redirect back with success message
    return redirect()->route('showUsers')->with('success', 'User account updated successfully.');
}



    public function forgotPass(){
        return view('pages.auth.forgotpass');
    }

    public function showUsers(){
        $users = utilisateurs::all();
        return view('pages.auth.showUsers', compact('users'));
    }

    public function searchUser(Request $request){

        $query = Utilisateurs::query();
        $query->where('id', $request->id);
        $users = $query->get();

        return view('pages.auth.showUsers', compact('users'));
    }

    public function deleteUser($id){

            $user = utilisateurs::find($id);
            $user->delete();
            return to_route('showUsers')->with('success','Client deleted !');


    }
}



?>
