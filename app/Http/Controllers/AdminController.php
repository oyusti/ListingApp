<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('listings')
                ->filter(request(['search', 'user_role']))
                ->paginate(10)
                ->withQueryString();
        
        return Inertia::render('Admin/AdminDashboard',[
            'users' => $users,
            'status' => session('status')
        ]);
    }

    public function show(User $user){

        $user_listings = $user
                        ->listings()
                        ->filter(request(['search', 'disapproved']))
                        ->latest()
                        ->paginate(10)
                        ->withQueryString();

        return Inertia::render('Admin/UserPage',[
            'user'      => $user,
            'listings'  => $user_listings,
            'status'    => session('status')
        ]);
    }

    public function role(Request $request, User $user)
    {

        Gate::authorize('modifyRole', $user);

        $request->validate([
            'role' => 'required|string'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('admin.index')->with('status', "User role changed {$request->role} successfully");
    }

    public function approve(Listing $listing){

        Gate::authorize('approve',$listing);

        $listing->update(['approved' => !$listing->approved]);

        $msg = $listing->approved ? 'approved' : 'disapproved';

        return back()->with('status', "Listing {$msg} succesfully");
    }
}
