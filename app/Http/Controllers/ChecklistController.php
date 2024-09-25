<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
    }
    public function index(Request $request)
    {
        $checklists = Checklist::all();
        return response()->json([
            'data' => $checklists,
            'message' => 'success',
        ],200);
    }

    public function store(Request $request)
    {
        $checklist = Checklist::create($request->all());
        return response()->json([
            'data' => $checklist,
            'message' => 'success save',
        ], 201);
    }

    public function destroy($id, Request $request)
    {
        $checklist = Checklist::findOrFail($id);
        $checklist->delete();
        return response()->json(null, 204);
    }
}
