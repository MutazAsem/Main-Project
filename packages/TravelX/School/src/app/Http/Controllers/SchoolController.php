<?php


namespace Travelx\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class SchoolController extends Controller{

    public function index(){
        $school = Str::of('School package Controllers');
        return view('school::Home',compact('school'));
    }
}