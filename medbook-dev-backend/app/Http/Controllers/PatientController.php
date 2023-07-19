<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        // Get all patient records
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function show($id)
    {

        // Show patient details
        $patient = Patient::find($id);

        if ($patient) {
            // Patient record found
            return response()->json($patient);
        } else {
            // Patient record not found
            return response()->json(['message' => 'Patient not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'blood_type' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
        ]);

        // Check if the patient already exists in the database
        $existingPatient = Patient::where('name', $request->input('name'))
            ->where('dob', $request->input('dob'))
            ->first();

        if ($existingPatient) {
            // If the patient already exists, return a response or update if needed
            return response()->json(['message' => 'Patient records exist'], 200);
        }

        // If the patient does not exist, create a new record
        $newPatient = new Patient($validatedData);
        $newPatient->save();

        return response()->json(['message' => 'Patient records created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        // Update patient records
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient records not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string',
            'dob' => 'date',
            'gender' => 'in:Male,Female,Other',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'blood_type' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
        ]);

        $patient->fill($validatedData);
        $patient->save();

        return response()->json(['message' => 'Patient records updated successfully'], 200);
    }

    public function destroy($id)
    {
        // Delete patient records
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient records not found'], 404);
        }

        $patient->delete();

        return response()->json(['message' => 'Patient records deleted successfully'], 200);
    }
}
