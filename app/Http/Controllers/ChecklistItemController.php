<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\ChecklistItem;

class ChecklistItemController extends Controller
{
    public function index($checklistId)
    {
        $checklist = Checklist::findOrFail($checklistId);
        return response()->json([
            'data' => $checklist->items,
            'message' => 'success',
        ],200);
    }

    public function store(Request $request, $checklistId)
    {
        $checklist = Checklist::findOrFail($checklistId);
        $item = $checklist->items()->create($request->all());
        return response()->json([
            'data' => $item,
            'message' => 'success',
        ], 201);
    }

    public function show($checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
                            ->where('id', $checklistItemId)
                            ->firstOrFail();
        return response()->json([
            'data' => $item,
            'message' => 'success',
        ],200);
    }
    public function update(Request $request, $checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
                            ->where('id', $checklistItemId)
                            ->firstOrFail();
                            
        $item->status = $request->get('status', $item->status);
        $item->save();

        return response()->json([
            'data' => $item,
            'message' => 'success',
        ],200);
    }

    public function destroy($checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
                            ->where('id', $checklistItemId)
                            ->firstOrFail();
        $item->delete();

        return response()->json(null, 204);
    }

    public function rename(Request $request, $checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)
                            ->where('id', $checklistItemId)
                            ->firstOrFail();

        $item->name = $request->get('itemName');
        $item->save();

        return response()->json([
            'data' => $item,
            'message' => 'success',
        ], 200);
    }
}
