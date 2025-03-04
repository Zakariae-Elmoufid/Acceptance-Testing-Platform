<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Candidat;
use App\Models\Staff;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   
     $validated =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'string','exists:roles,id'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ];
        
        // \Log::info('Tentative de création utilisateur avec:', $userData);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        if ($request->role_id == '1') {
            if ($request->hasFile('document')) {
                $documentPath = $request->file('document')->store('document', 'public');
            }
            $candidat =  Candidat::create([
                'user_id' => $user->id,  
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'phone' => $request->phone,
                'document' => $documentPath,
            ]);
            session(['candidat_id' => $candidat->id]);

        } else {
            if ($request->hasFile('profile_photo')) {
                $profilePhotoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            }
            $staff = Staff::create([
                'user_id' => $user->id, 
                'profile_photo' => $profilePhotoPath,
                'type' => $user->role->role,
            ]);
                 session(['staff_id' => $staff->id]);

        }

        event(new Registered($user));

        Auth::login($user);
         
        if(Auth::user()->role_id == "1"){
            session(['candidat_id' => Auth::id()]);
            return  redirect()->intended(route('quiz'));
        }else if(Auth::user()->role_id == "5"){
            return  redirect()->intended(route('admin.dashboard'));
        }else {
            return redirect()->intended(route('satff'));
        }
    }
}
