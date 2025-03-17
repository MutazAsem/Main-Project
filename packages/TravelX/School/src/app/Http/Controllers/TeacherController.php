<?php

namespace Travelx\School\App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Travelx\School\App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('school::TeacherList')->with([
            'teachers' =>$teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school::TeacherCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|unique:Teachers,phone_number',
        ]);
        
        Teacher::create($validated);

        return redirect()->route('teachers.index')->with([
            'success' => 'Teacher created successfully!',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('school::TeacherShow')->with([
            'teacher' =>$teacher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('school::TeacherEdit')->with([
            'teacher' =>$teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|unique:Teachers,phone_number,' . $teacher->id,
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with([
            'success' => 'Teacher updated successfully!',
        ]);

    }

    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with([
            'success' => 'Teacher deleted successfully!',
        ]);
    }
}
