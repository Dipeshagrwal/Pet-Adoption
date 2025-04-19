<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\PetBreed;
use App\Models\AdoptionRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminPetController extends Controller
{
     public function listPendingPets()
{
    // Get counts for each status
    $totalPets = Pet::count();
    $approvedCount = Pet::where('status', 'approved')->count();
    $pendingCount = Pet::where('status', 'pending')->count();
    $rejectedCount = Pet::where('status', 'rejected')->count();

    // Retrieve only pending pets
    $pendingPets = Pet::with('user')
        ->where('status', 'pending')
        ->latest()
        ->paginate(10);

    // Pass the counts and pending pets to the view
    return view('admin.pets.pending', compact('pendingPets', 'totalPets', 'approvedCount', 'pendingCount', 'rejectedCount'));
}
    public function listAllPets()
    {
        // Get counts for each status
        $approvedCount = Pet::where('status', 'approved')->count();
        $pendingCount = Pet::where('status', 'pending')->count();
        $rejectedCount = Pet::where('status', 'rejected')->count();

        // Get the status filter from the request
        $status = request('status');

        // Query pets based on the status filter
        $pets = Pet::with(['user'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        // Pass the data to the view
        return view('admin.pets.index', compact('pets', 'approvedCount', 'pendingCount', 'rejectedCount', 'status'));
    }

    // Admin: View only pending pets
    

    // Admin: View all pets
    public function index()
{
    // Get counts for each status
    $totalPets = Pet::count();
    $approvedCount = Pet::where('status', 'approved')->count();
    $pendingCount = Pet::where('status', 'pending')->count();
    $rejectedCount = Pet::where('status', 'rejected')->count();

    // Get the status filter from the request
    $status = request('status');

    // Query pets based on the status filter
    $pets = Pet::with(['user'])
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->latest()
        ->paginate(10);

    // Pass the data to the view
    return view('admin.pets.index', compact('pets', 'totalPets', 'approvedCount', 'pendingCount', 'rejectedCount', 'status'));
}

    // Admin: Add a new pet (CRUD Create)
    public function create()
    {
        $states = State::orderBy('name')->get();
        $petTypes = PetType::all(); // Fetch all pet types
        $petBreeds = PetBreed::all();    
        return view('admin.pets.create', compact('petTypes', 'states','petBreeds'));
    }

    public function store(Request $request)
    {
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
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Single image upload
        ]);

        $pet = new Pet();
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
        $pet->state = State::find($validated['state_id'])->name;
        $pet->city = City::find($validated['city_id'])->name;
        $pet->status = 'Approved';  // Admin adds pets as approved by default
        $pet->pet_status = 'Available';  // Initially, the pet status is 'Available'
        $pet->user_id = auth()->id();  // Admin can associate the user

        // Handle single image upload
        if ($request->hasFile('image')) {
            $pet->image = $request->file('image')->store('pets', 'public'); // Store the image and get the path
        }

        $pet->save();

        return redirect()->route('admin.pets.index')->with('success', 'Pet added successfully.');
    }

    // Admin: Edit pet details (CRUD Update)
    public function edit($petId)
    {
        $states = State::orderBy('name')->get();
        $pet = Pet::findOrFail($petId);
        $petTypes = PetType::all(); // Fetch all pet types
        $petBreeds = PetBreed::all();

        // Fetch cities based on the pet's state
        $cities = City::where('state_id', $pet->state_id)->get();

        return view('admin.pets.edit', compact('states', 'pet', 'petBreeds', 'petTypes', 'cities'));
    }

    public function update($petId, Request $request)
    {
        $pet = Pet::findOrFail($petId);

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
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update state and city
        $validated['state'] = State::find($validated['state_id'])->name;
        $validated['city'] = City::find($validated['city_id'])->name;

        // Update pet details
        $pet->name = $validated['name'];
        $pet->dob = $validated['dob'];
        $pet->pet_type_id = $validated['pet_type_id'];
        $pet->pet_breed_id = $validated['pet_breed_id'];
        $pet->gender = $validated['gender'];
        $pet->vaccinated = $validated['vaccinated'];
        $pet->pet_characteristics = $validated['pet_characteristics'];
        $pet->owner_name = $validated['owner_name'];
        $pet->whatsapp_no = $validated['whatsapp_no'];
        $pet->description = $validated['description'];
        $pet->state = $validated['state'];
        $pet->city = $validated['city'];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($pet->image) {
                Storage::disk('public')->delete($pet->image);
            }
            // Store new image
            $pet->image = $request->file('image')->store('pets', 'public');
        }

        $pet->save(); // Save the updated pet details

        return redirect()->route('admin.pets.index')->with('success', 'Pet details updated successfully.');
    }

    // Admin: Delete pet (CRUD Delete)
    public function destroy($petId)
    {
        $pet = Pet::findOrFail($petId);
        $pet->delete();

        return redirect()->route('admin.pets.index')->with('success', 'Pet deleted successfully.');
    }

    public function show(Pet $pet)
    {
        return view('admin.pets.show', compact('pet'));
    }

    // Add this method to your AdminPetController
public function dashboard()
{
    // Basic stats
    $totalPets = Pet::count();
    $adoptedPets = Pet::where('pet_status', 'Adopted')->count();
    $pendingPets = Pet::where('status', 'Pending')->count();
    $totalUsers = User::count();

    // Pet types distribution
    $petTypes = PetType::withCount('pets')->orderBy('pets_count', 'desc')->get();

    // Popular breeds
    $popularBreeds = PetBreed::with(['petType', 'pets'])
        ->withCount('pets')
        ->orderBy('pets_count', 'desc')
        ->take(5)
        ->get();

    // Adoption rate (last 7 days)
    $adoptionRate = AdoptionRequest::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('status', 'Approved')
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Recent activities
    $recentActivities = [
        [
            'description' => 'New pet "Max" added by JohnDoe',
            'time' => '2 minutes ago',
            'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
            'color' => 'blue'
        ],
        [
            'description' => 'Pet "Whiskers" has been adopted',
            'time' => '1 hour ago',
            'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
            'color' => 'green'
        ],
        [
            'description' => 'New user registration: JaneSmith',
            'time' => '3 hours ago',
            'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            'color' => 'purple'
        ],
        [
            'description' => '5 new pets pending approval',
            'time' => '5 hours ago',
            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'color' => 'yellow'
        ],
    ];

    return view('admin.dashboard', compact(
        'totalPets',
        'adoptedPets',
        'pendingPets',
        'totalUsers',
        'petTypes',
        'popularBreeds',
        'adoptionRate',
        'recentActivities'
    ));
}
}