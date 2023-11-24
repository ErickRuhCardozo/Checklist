<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checklist;
use App\Http\Controllers\Controller;
use App\Models\PlaceAllowedUsers;
use App\Models\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ChecklistController extends Controller
{
    public function index()
    {
        if (Auth::user()->type === UserType::ADMIN)
            $checklists = Checklist::query();
        else if (Auth::user()->type === UserType::COORDINATOR)
            $checklists = Checklist::join('users', 'checklists.user_id', '=', 'users.id')
                                   ->where('users.unity_id', Auth::user()->unity_id);

        return View::make('admin.checklists.index', [
            'checklists' => $checklists->orderBy('created_at', 'desc')
                                       ->simplePaginate(10)
        ]);
    }

    public function show(Checklist $checklist)
    {
        $allowedPlaces = PlaceAllowedUsers::where('user_type', $checklist->user->type->value)
                                          ->get()
                                          ->map(fn($allowedPlace) => $allowedPlace->place)
                                          ->where(fn($place) => $place->unity->id === $checklist->user->unity_id);

        if ($checklist->is_done)
            $allowedPlaces = $allowedPlaces->where(fn($place) => $place->created_at->lte($checklist->created_at));

        $notScannedPlaces = $allowedPlaces->diff($checklist->checkedPlaces());

        return View::make('admin.checklists.show', [
            'checklist' => $checklist,
            'allowedPlaces' => $allowedPlaces,
            'notScannedPlaces' => $notScannedPlaces
        ]);
    }
}
