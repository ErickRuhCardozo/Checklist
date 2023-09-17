<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\PlaceAllowedUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ChecklistController extends Controller
{
    public function index()
    {
        return View::make('employee.checklists.index', [
            'checklists' => Auth::user()->checklists()->get(),
        ]);
    }

    public function create()
    {
        $checklist = Checklist::create([
            'user_id' => Auth::id(),
        ]);

        Auth::user()->update(['current_checklist_id' => $checklist->id]);
        return Redirect::route('employee.scans.create');
    }

    public function show(Checklist $checklist)
    {
        $allowedPlaces = PlaceAllowedUsers::where('user_type', $checklist->user->type->value)
                                          ->get()
                                          ->map(fn($allowedPlace) => $allowedPlace->place)
                                          ->where(fn($place) => $place->unity->id === $checklist->user->unity_id);
        $notScannedPlaces = $allowedPlaces->diff($checklist->checkedPlaces());

        return View::make('employee.checklists.show', [
            'checklist' => $checklist,
            'notScannedPlaces' => $notScannedPlaces,
        ]);
    }

    public function continueChecklist(Request $request)
    {
        if (Auth::user()->currentChecklist === null)
            return Redirect::route('employee.checklists.create');

        if ($request->has('checklist'))
            Auth::user()->update(['current_checklist_id' => $request->get('checklist')]);

        return Redirect::route('employee.scans.create');
    }
}

