<?php
namespace App\Http\Controllers;
use App\Mail\PetApprovalNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\City;
use App\Models\State;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\PetBreed;
use Illuminate\Http\Request;

class PetController extends Controller
{
    // User: View all pets (only approved pets)
    public function index()
    {
        $pets = Pet::where('user_id', auth()->id())->get(); 
        $pets = auth()->user()->pets()->with('petType')->paginate(10);// Only show pets owned by the authenticated user
        return view('user.pets.index', compact('pets'));
    }

    // User: View a single pet
    public function show(Pet $pet)
    {
        // Ensure the pet belongs to the authenticated user
        if ($pet->user_id !== auth()->id()) {
            return redirect()->route('user.pets.index')->with('error', 'You do not have permission to view this pet.');
        }

        return view('user.pets.show', compact('pet'));
    }

    // User: Show the form to add a new pet
    public function create()
    {
        $states = State::orderBy('name')->get();
        $petTypes = PetType::all(); // Fetch all pet types
        $petBreeds = PetBreed::all();    
        return view('user.pets.create', compact('states','petTypes', 'petBreeds'));
    }

    // User: Add a new pet (status = Pending)
    public function store(Request $request)
    {
        $stateName = State::find($request->state_id)?->name;
        $cityName = City::find($request->city_id)?->name;
        // Store a new pet
        $pet = Pet::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'pet_type_id' => $request->pet_type_id,
            'pet_breed_id' => $request->pet_breed_id,
            'gender' => $request->gender,
            'vaccinated' => $request->vaccinated,
            'pet_characteristics' => $request->pet_characteristics,
            'city' => $stateName,
            'state' => $cityName,
            'owner_name' => $request->owner_name,
            'whatsapp_no' => $request->whatsapp_no,
            'description' => $request->description,
            'image' => $request->file('image')->store('pets', 'public'),
            'status' => 'Pending',
            'pet_status' => 'Available',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('pets.approved')->with('success', 'Pet added successfully and is pending approval.');
    }

    // User: Show the form to edit a pet
    public function edit(Pet $pet)
    {
        // Ensure the pet belongs to the authenticated user
        if ($pet->user_id !== auth()->id()) {
            return redirect()->route('user.pets.index')->with('error', 'You do not have permission to edit this pet.');
        }
        $states = State::orderBy('name')->get();
        $petTypes = PetType::all(); // Fetch all pet types
        $petBreeds = PetBreed::all();
        return view('user.pets.edit', compact('states','pet', 'petTypes', 'petBreeds'));
    }

    // User: Update a pet (status = Pending for admin review)
    public function update(Request $request, Pet $pet)
    {
        // Ensure the pet belongs to the authenticated user
        if ($pet->user_id !== auth()->id()) {
            return redirect()->route('user.pets.index')->with('error', 'You do not have permission to update this pet.');
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'pet_type_id' => 'required|exists:pet_types,id',
            'pet_breed_id' => 'required|exists:pet_breeds,id',
            'gender' => 'required|string',
            'vaccinated' => 'required|in:Vaccinated,Not Vaccinated',
            'pet_characteristics' => 'required|string', // Added: Pet characteristics
            'owner_name' => 'required|string', // Added: Owner's name
            'whatsapp_no' => 'required|string',
            'description' => 'required|string',
            'state' => 'required|string', // Added: State
            'city' => 'required|string', // Added: City
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Single image upload
        ]);

        $pet->name = $validated['name'];
        $pet->dob = $validated['dob'];
        $pet->pet_type_id = $validated['pet_type_id'];
        $pet->pet_breed_id = $validated['pet_breed_id'];
        $pet->gender = $validated['gender'];
        $pet->vaccinated = $validated['vaccinated'];
        $pet->pet_characteristics = $validated['pet_characteristics']; // Added: Pet characteristics
        $pet->owner_name = $validated['owner_name']; // Added: Owner's name
        $pet->whatsapp_no = $validated['whatsapp_no'];
        $pet->description = $validated['description'];
        $pet->state = $validated['state']; // Added: State
        $pet->city = $validated['city']; // Added: City
        $pet->status = 'Pending'; // Set status to Pending for admin review
        $pet->edited_status = 'Pending'; // Mark as pending for admin review

        // Handle single image upload
        if ($request->hasFile('image')) {
            $pet->image = $request->file('image')->store('pets', 'public'); // Store the image and get the path
        }

        $pet->save();

        return redirect()->route('user.pets.index')->with('success', 'Your pet has been updated and is pending review.');
    }

    // User: Delete a pet
    public function destroy(Pet $pet)
    {
        // Ensure the pet belongs to the authenticated user
        if ($pet->user_id !== auth()->id()) {
            return redirect()->route('user.pets.index')->with('error', 'You do not have permission to delete this pet.');
        }

        $pet->delete();
        return redirect()->route('user.pets.index')->with('success', 'Your pet has been deleted.');
    }

 public function approved(Request $request)
{
    $query = Pet::where('status', 'approved')->where('pet_status', 'Available');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('city', 'like', "%{$search}%")
              ->orWhere('state', 'like', "%{$search}%");
        });
    }

    if ($request->filled('category')) {
        $query->where('pet_type_id', $request->category);
    }

    if ($request->filled('breed')) {
        $query->where('pet_breed_id', $request->breed);
    }

    if ($request->filled('location')) {
        $location = $request->location;
        $query->where(function ($q) use ($location) {
            $q->where('city', 'like', "%{$location}%")
              ->orWhere('state', 'like', "%{$location}%");
        });
    }

    $approvedPets = $query->with(['petType', 'petBreed'])->paginate(6)->withQueryString();
    $approvedPets = $query->paginate(8)->withQueryString();
    $types = PetType::all();
    $breeds = PetBreed::all();

    return view('welcome', compact('approvedPets', 'types', 'breeds'));
}



    public function pending()
    {
        // Show pending pets for admin
        $pendingPets = Pet::where('status', 'Pending')->get();
        return view('admin.pets.pending', compact('pendingPets'));
    }


public function approve($id)
{
    // Approve a pet
    $pet = Pet::findOrFail($id);
    $pet->status = 'Approved';
    $pet->save();

    // Send approval email to the pet owner (if email exists)
    if ($pet->user && $pet->user->email) {
        Mail::to($pet->user->email)->send(new PetApprovalNotification($pet));
    }

    return redirect()->route('admin.pets.pending')->with('success', 'Pet approved and notification email sent successfully.');
}


    public function reject(Request $request, $id)
    {
        // Find the pet by ID
        $pet = Pet::findOrFail($id);
        // Update the pet's status to 'Rejected'
        $pet->status = 'Rejected';
        // Store the rejection reason if provided
        if ($request->has('rejection_reason')) {
            $pet->rejected_reason = $request->input('rejection_reason');
        }
        $pet->save();
        // Redirect back to the pending pets page with a success message
        return redirect()->route('admin.pets.pending')->with('success', 'Pet rejected successfully.');
    }

    public function showDetails(Pet $pet)
{
    // Load relationships
    $pet->load(['petType', 'petBreed', 'user']);
    
    return view('user.pet-details', compact('pet'));
}

public function adoptedPets()
{
    $adoptedPets = Pet::where('pet_status', 'Adopted')->paginate(12);
    return view('user.pets.adopted', compact('adoptedPets'));
}


}