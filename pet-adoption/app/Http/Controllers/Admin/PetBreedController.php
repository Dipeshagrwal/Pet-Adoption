<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetBreed;
use App\Models\PetType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PetBreedController extends Controller
{
    public function index(Request $request)
{
    $query = PetBreed::with('petType');

    if ($request->filled('search')) {
        $query->where('breed', 'LIKE', '%' . $request->search . '%');
    }

    if ($request->filled('pet_type_id')) {
        $query->where('pet_type_id', $request->pet_type_id);
    }

    $breeds = $query->orderBy('id', 'desc')->paginate(10);

    $petTypes = PetType::all(); // For dropdown filter

    return view('admin.pet_breeds.index', compact('breeds', 'petTypes'));
}


    public function create()
    {
        $types = PetType::all();
        return view('admin.pet_breeds.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_type_id' => 'required|exists:pet_types,id',
            'breed' => 'required|string|max:255',
        ]);

        PetBreed::create($request->all());

        return redirect()->route('pet_breeds.index')->with('success', 'Breed added successfully.');
    }

    public function edit(PetBreed $petBreed)
    {
        $types = PetType::all();
        return view('admin.pet_breeds.edit', compact('petBreed', 'types'));
    }

    public function update(Request $request, PetBreed $petBreed)
    {
        $request->validate([
            'pet_type_id' => 'required|exists:pet_types,id',
            'breed' => 'required|string|max:255',
        ]);

        $petBreed->update($request->all());

        return redirect()->route('pet_breeds.index')->with('success', 'Breed updated successfully.');
    }

    public function destroy(PetBreed $petBreed)
    {
        $petBreed->delete();
        return redirect()->route('pet_breeds.index')->with('success', 'Breed deleted successfully.');
    }
   
public function exportPDF()
{
    $breeds = PetBreed::with('petType')->get();
    $pdf = Pdf::loadView('admin.pet_breeds.pdf', compact('breeds'));
    return $pdf->download('pet_breeds_report.pdf');
}

public function getBreedsByType($type_id)
{
    return PetBreed::where('pet_type_id', $type_id)->select('id', 'breed')->get();
}

}


?>
