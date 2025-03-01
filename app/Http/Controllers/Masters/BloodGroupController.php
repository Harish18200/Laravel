<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;

class BloodGroupController extends Controller
{
    public function index()
    {

        $bloodGroups = BloodGroup::all();
        return response()->json(['status' => True, 'bloodGroups' => $bloodGroups], 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:blood_groups|max:10',
        ]);
        $bloodGroup = BloodGroup::create(['name' => $request['name']]);

        return response()->json(['status' => True, 'message' => 'Blood group added successfully', 'data' => $bloodGroup], 201);
    }

    public function edit($id)
    {

        $bloodGroup = BloodGroup::find($id);

        if (!$bloodGroup) {
            return response()->json(['status' => True, 'message' => 'Blood group not found'], 404);
        }

        return response()->json($bloodGroup, 200);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:10|unique:blood_groups,name,' . $id,
        ]);

        $bloodGroup = BloodGroup::find($id);
        if (!$bloodGroup) {
            return response()->json(['status' => True, 'message' => 'Blood group not found'], 404);
        }
        $bloodGroup->update(['name' => $request->name]);
        return response()->json(['status' => True, 'message' => 'Blood group updated successfully', 'data' => $bloodGroup], 200);
    }


    public function destroy($id)
    {
        $bloodGroup = BloodGroup::find($id);

        if (!$bloodGroup) {
            return response()->json(['status' => True, 'message' => 'Blood group not found'], 404);
        }

        $bloodGroup->delete();

        return response()->json(['status' => True, 'message' => 'Blood group deleted successfully'], 200);
    }
}
