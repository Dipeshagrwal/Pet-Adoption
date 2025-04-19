<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetType;
use Illuminate\Http\Request;

class PetTypeController extends Controller
{
    // List all pet types
    public function index(Request $request)
    {
        $query = PetType::query();

    // Search
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Example filter by starting alphabet (optional)
        if ($request->has('starts_with')) {
            $query->where('name', 'LIKE', $request->starts_with . '%');
        }

        $types = $query->orderBy('id', 'DESC')->paginate(10);

        //$types = PetType::all();
        return view('admin.pet_types.index', compact('types'));
    }

    // Show the form to create a new pet category
    public function create()
    {
        return view('admin.pet_types.create');
    }

    // Store a new pet category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PetType::create($request->only('name'));

        return redirect()->route('pet_types.index')->with('success', 'Pet category created successfully.');
    }

    // Show the form to edit a pet category
    public function edit($id)
    {
        // Fetch the pet type by ID
        $petType = PetType::findOrFail($id); // Ensure you have the correct model

        // Pass the pet type to the view
        return view('admin.pet_types.edit', compact('petType'));
    }

    // Update a pet category
    public function update(Request $request, PetType $pet_type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pet_type->update($request->only('name'));

        return redirect()->route('pet_types.index')->with('success', 'Pet category updated successfully.');
    }

    // Delete a pet category
    public function destroy(PetType $pet_type)
    {
        $pet_type->delete();
        return redirect()->route('pet_types.index')->with('success', 'Pet category deleted successfully.');
    }
}
