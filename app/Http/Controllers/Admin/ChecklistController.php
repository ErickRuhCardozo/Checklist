<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checklist;
use App\Http\Controllers\Controller;
use App\Models\PlaceAllowedUsers;
use Illuminate\Support\Facades\View;

class ChecklistController extends Controller
{
    public function index()
    {
        return View::make('admin.checklists.index', [
            'checklists' => Checklist::all()
        ]);
    }

    public function show(Checklist $checklist)
    {
        $allowedPlaces = PlaceAllowedUsers::where('user_type', $checklist->user->type->value)
                                          ->get()
                                          ->map(fn($allowedPlace) => $allowedPlace->place)
                                          ->where(fn($place) => $place->unity->id === $checklist->user->unity_id);
        $notScannedPlaces = $allowedPlaces->diff($checklist->checkedPlaces());

        return View::make('admin.checklists.show', [
            'checklist' => $checklist,
            'allowedPlaces' => $allowedPlaces,
            'notScannedPlaces' => $notScannedPlaces
        ]);
    }
}
