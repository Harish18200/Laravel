<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\PaymentMode;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{

    // List all payment modes
    public function index()
    {
        $paymentModes = PaymentMode::all();
        return response()->json(['status' => True, 'paymentModes' => $paymentModes], 200);
    }

    // Store new payment mode
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:payment_modes,name',
            'remark' => 'nullable|string'
        ]);

        $paymentMode = PaymentMode::create([
            'name' => $request->name,
            'remark' => $request->remark
        ]);

        return response()->json(['status' => True, 'message' => 'Payment Mode added successfully', 'data' => $paymentMode], 201);
    }

    // Show specific payment mode
    public function show($id)
    {
        $paymentMode = PaymentMode::find($id);

        if (!$paymentMode) {
            return response()->json(['status' => True, 'message' => 'Payment Mode not found'], 404);
        }

        return response()->json($paymentMode);
    }

    // Update payment mode
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:payment_modes,name,' . $id,
            'remark' => 'nullable|string'
        ]);

        $paymentMode = PaymentMode::find($id);

        if (!$paymentMode) {
            return response()->json(['status' => True, 'message' => 'Payment Mode not found'], 404);
        }

        $paymentMode->update([
            'name' => $request->name,
            'remark' => $request->remark
        ]);

        return response()->json(['status' => True, 'message' => 'Payment Mode updated successfully', 'data' => $paymentMode]);
    }

    public function destroy($id)
    {
        $paymentMode = PaymentMode::find($id);

        if (!$paymentMode) {
            return response()->json(['status' => True, 'message' => 'Payment Mode not found'], 404);
        }

        $paymentMode->delete();
        return response()->json(['status' => True, 'message' => 'Payment Mode deleted successfully']);
    }
}
