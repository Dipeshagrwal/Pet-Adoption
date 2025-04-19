<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:summary,detailed,adoptions,users',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:pdf'
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        
        $data = $this->getReportData($validated['type'], $startDate, $endDate);
        
        $pdf = PDF::loadView('reports.'.$validated['type'], $data);
        
        return $pdf->download('pet_adoption_report_'.now()->format('Y-m-d').'.pdf');
    }

    protected function getReportData($type, $startDate, $endDate)
    {
        $data = [
            'start_date' => $startDate->format('F j, Y'),
            'end_date' => $endDate->format('F j, Y'),
            'generated_at' => now()->format('F j, Y H:i'),
        ];

        switch ($type) {
            case 'summary':
                $data['total_pets'] = Pet::count();
                $data['adopted_pets'] = Pet::where('status', 'adopted')->count();
                $data['new_users'] = User::whereBetween('created_at', [$startDate, $endDate])->count();
                break;

            case 'detailed':
                $data['pets'] = Pet::with('type')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;

            case 'adoptions':
                $data['adoptions'] = Pet::with(['type', 'adopter'])
                    ->where('status', 'adopted')
                    ->whereBetween('adoption_date', [$startDate, $endDate])
                    ->orderBy('adoption_date', 'desc')
                    ->get();
                break;

            case 'users':
                $data['users'] = User::withCount(['pets', 'adoptions'])
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
        }

        return $data;
    }
}