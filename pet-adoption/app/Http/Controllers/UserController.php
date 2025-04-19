<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\PetBreed;


class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $users = User::all(); // You can paginate if needed
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update the specified user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $user->update($request->all());
        return redirect()->route('users.index');
    }

    // Remove the specified user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
    public function dashboard()
    {
        $user = auth()->user();

    if ($user->role !== 'user') {
        abort(403, 'Unauthorized action.');
    }
        
        // Basic stats
        $stats = [
            'total_pets' => $user->pets()->count(),
            'approved_pets' => $user->pets()->where('status', 'approved')->count(),
            'pending_pets' => $user->pets()->where('status', 'pending')->count(),
            'adopted_pets' => $user->pets()->where('pet_status', 'Adopted')->count(),
            'available_pets' => $user->pets()->where('pet_status', 'Available')->count(),
            'total_requests' => AdoptionRequest::whereHas('pet', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count(),
            'approved_requests' => AdoptionRequest::whereHas('pet', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where('status', 'Approved')->count(),
            'pending_requests' => AdoptionRequest::whereHas('pet', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where('status', 'Pending')->count(),
            'adoption_rate' => $user->pets()->count() > 0 ? 
                round(($user->pets()->where('pet_status', 'Adopted')->count() / $user->pets()->count()) * 100) : 0,
            'available_percentage' => $user->pets()->count() > 0 ? 
                round(($user->pets()->where('pet_status', 'Available')->count() / $user->pets()->count()) * 100) : 0,
        ];

        // Pet types distribution
        $petTypes = PetType::withCount(['pets' => function($q) use ($user) {
            $q->where('user_id', $user->id);
        }])->get();

        // User's pets for chart data
        $userPets = $user->pets()->with('petType')->get() ?? collect();       
        // Recent activities
        $recentActivities = [
            [
                'description' => 'Added new pet "'.($user->pets()->latest()->first()->name ?? 'N/A').'"',
                'time' => $user->pets()->latest()->first() ? $user->pets()->latest()->first()->created_at->diffForHumans() : 'No pets yet',
                'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
                'color' => 'blue'
            ],
            [
                'description' => 'You have '.$stats['pending_requests'].' pending adoption requests',
                'time' => 'Active',
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'color' => 'yellow'
            ],
            [
                'description' => $stats['adopted_pets'].' of your pets have been adopted',
                'time' => 'Total',
                'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'color' => 'green'
            ],
        ];

        // Pending adoption requests
        $pendingRequests = AdoptionRequest::with('pet')
            ->whereHas('pet', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'Pending')
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'stats',
            'petTypes',
            'userPets',
            'recentActivities',
            'pendingRequests'
        ));
    }

}
