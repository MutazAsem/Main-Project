<?php

namespace Travelx\School\App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Travelx\School\App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json(['students' => $students], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Ready to create a new student'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        $student = Student::create($validated);

        return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return response()->json(['student' => $student], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        return response()->json(['student' => $student], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return response()->json(['message' => 'Student updated successfully', 'student' => $student], 200);
    }

    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}
