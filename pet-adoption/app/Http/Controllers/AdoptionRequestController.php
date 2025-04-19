<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionRequestController extends Controller
{
    // Store adoption request
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'adopter_name' => 'required|string|max:255',
            'adopter_contact' => 'required|string|max:255',
        ]);

        $pet = Pet::findOrFail($request->pet_id);

        // Prevent self-adoption
        if ($pet->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot adopt your own pet.');
        }

        $adoptionRequest = AdoptionRequest::create([
            'pet_id' => $pet->id,
            'user_id' => Auth::id(),
            'adopter_name' => $request->adopter_name,
            'adopter_contact' => $request->adopter_contact,
            'status' => 'Pending',
        ]);

        return redirect()->route('welcome')->with('success', 'Adoption request submitted successfully.');
    }

    // Show adoption requests (for pet owners)
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = AdoptionRequest::whereHas('pet', function ($query) {
            $query->where('user_id', Auth::id())
                  ->whereHas('user', function ($q) {
                      $q->where('role', 'user');
                  });
        })
        ->with(['pet', 'user'])
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('adopter_name', 'like', "%{$search}%")
                    ->orWhere('adopter_contact', 'like', "%{$search}%")
                    ->orWhereHas('pet', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        });

        $adoptionRequests = $query->latest()->paginate(9);

        $counts = [
            'pending' => $query->clone()->where('status', 'Pending')->count(),
            'approved' => $query->clone()->where('status', 'Approved')->count(),
            'rejected' => $query->clone()->where('status', 'Rejected')->count(),
            'all' => $query->clone()->count(),
        ];

        $searchMessage = null;
        if ($search && $adoptionRequests->isEmpty()) {
            $searchMessage = "No adoption requests found matching '{$search}'";
        } elseif ($search) {
            $searchMessage = "Showing results for '{$search}'";
        }

        return view('adoption-request.index', compact(
            'adoptionRequests',
            'counts',
            'search',
            'status',
            'searchMessage'
        ));
    }

    // Show adoption requests (admin if pet owner is admin)
    public function adminIndex(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = AdoptionRequest::whereHas('pet.user', function ($q) {
                $q->where('role', 'admin');
            })
            ->with(['pet', 'user'])
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('adopter_name', 'like', "%{$search}%")
                        ->orWhere('adopter_contact', 'like', "%{$search}%")
                        ->orWhereHas('pet', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                              ->orWhere('breed', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            });

        $adoptionRequests = $query->latest()->paginate(10);

        $counts = [
            'pending' => $query->clone()->where('status', 'Pending')->count(),
            'approved' => $query->clone()->where('status', 'Approved')->count(),
            'rejected' => $query->clone()->where('status', 'Rejected')->count(),
            'all' => $query->clone()->count(),
        ];

        return view('admin.adoption-requests.index', compact(
            'adoptionRequests',
            'counts',
            'search',
            'status'
        ));
    }

    // Show adoption requests made by current user (adopter)
    public function adopterIndex(Request $request)
{
    $search = $request->query('search');
    $status = $request->query('status');

    $baseQuery = AdoptionRequest::where('user_id', Auth::id())
        ->with(['pet', 'pet.user']);

    $filteredQuery = clone $baseQuery;
    $filteredQuery->when($status, fn($q) => $q->where('status', $status))
        ->when($search, function ($q) use ($search) {
            $q->where(function ($q) use ($search) {
                $q->where('adopter_name', 'like', "%{$search}%")
                  ->orWhere('adopter_contact', 'like', "%{$search}%")
                  ->orWhereHas('pet', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        });

    $adoptionRequests = $filteredQuery->latest()->paginate(9);

    $counts = [
        'pending' => $baseQuery->where('status', 'Pending')->count(),
        'approved' => $baseQuery->where('status', 'Approved')->count(),
        'rejected' => $baseQuery->where('status', 'Rejected')->count(),
        'all' => $baseQuery->count(),
    ];

    return view('adopter.adoptions.index', compact('adoptionRequests', 'counts', 'search', 'status'));
}

public function adopterIndexs(Request $request)
{
    $search = $request->query('search');
    $status = $request->query('status');

    $baseQuery = AdoptionRequest::where('user_id', Auth::id())
        ->with(['pet', 'pet.user']);

    $filteredQuery = clone $baseQuery;
    $filteredQuery->when($status, fn($q) => $q->where('status', $status))
        ->when($search, function ($q) use ($search) {
            $q->where(function ($q) use ($search) {
                $q->where('adopter_name', 'like', "%{$search}%")
                  ->orWhere('adopter_contact', 'like', "%{$search}%")
                  ->orWhereHas('pet', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        });

    $adoptionRequests = $filteredQuery->latest()->paginate(9);

    $counts = [
        'pending' => (clone $baseQuery)->where('status', 'Pending')->count(),
        'approved' => (clone $baseQuery)->where('status', 'Approved')->count(),
        'rejected' => (clone $baseQuery)->where('status', 'Rejected')->count(),
        'all' => (clone $baseQuery)->count(),
    ];

    return view('admin.adoptions.index', compact('adoptionRequests', 'counts', 'search', 'status'));
}

    // Update adoption request status (for pet owner)
    public function update(Request $request, AdoptionRequest $adoptionRequest)
    {
        if ($adoptionRequest->pet->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'rejection_reason' => 'required_if:status,Rejected|string|max:255',
        ]);

        $adoptionRequest->update($validated);

        if ($validated['status'] === 'Approved') {
            $adoptionRequest->pet()->update([
                'pet_status' => 'Adopted',
                'adopted_at' => now(),
            ]);

            // Reject all other pending requests for this pet
            AdoptionRequest::where('pet_id', $adoptionRequest->pet_id)
                ->where('id', '!=', $adoptionRequest->id)
                ->where('status', 'Pending')
                ->update(['status' => 'Rejected', 'rejection_reason' => 'Pet already adopted']);
        }

        return redirect()->route('adoption-request.index')->with('success', 'Adoption request updated successfully.');
    }

    // Admin update adoption request
    public function adminUpdate(Request $request, AdoptionRequest $adoptionRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'rejection_reason' => 'required_if:status,Rejected|string|max:255',
        ]);

        $adoptionRequest->update($validated);

        if ($validated['status'] === 'Approved') {
            $adoptionRequest->pet()->update([
                'pet_status' => 'Adopted',
                'adopted_at' => now(),
            ]);
        }

        return redirect()->route('admin.adoption-requests.index')->with('success', 'Adoption request updated successfully.');
    }
}
