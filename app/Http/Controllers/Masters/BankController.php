<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return response()->json(['status' => True, 'bank' => $banks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:banks',
        ]);

        $bank = Bank::create([
            'name' => $request->name,
        ]);

        return response()->json(['status' => True,'message' => 'Bank created successfully', 'bank' => $bank], 201);
    }

    // Show single bank
    public function show($id)
    {
        $bank = Bank::findOrFail($id);
        return response()->json(['status' => True, 'bank' => $bank]);
    }

    // Update bank
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:banks,name,' . $id,
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update(['name' => $request->name]);

        return response()->json(['status' => True, 'message' => 'Bank updated successfully', 'bank' => $bank]);
    }

    // Delete bank
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return response()->json(['status' => True, 'message' => 'Bank deleted successfully']);
    }
}
