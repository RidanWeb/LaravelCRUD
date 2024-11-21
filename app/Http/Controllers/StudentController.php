<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;c

class StudentController extends Controller
{
    //this method is responsible for showing student page
    public function index(){
        $students = Student::orderBy('created_at', 'DESC')->get();
        return view('student.list', [
            'students' => $students
        ]);
    }

    //this method is responsible for creating student
    public function create(){
        return view('student.create');
    }

    //this method is responsible for storing student
    public function store(Request $request){

        $rules = [
            'name' => 'required|min:5',
            'email' => 'required',
            'age' => 'required|numeric:2'
        ];

        if($request ->image != ""){
            $rules['image'] = 'image';
        }

        $validation = Validator::make($request->all(), $rules);

        if($validation -> fails()){
            return redirect()->route('student.create')->withInput()->withErrors($validation);
        }

        //insert student info from here=============
        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->age = $request->age;
        $student->description = $request->description;
        $student->save();


        if($request ->image != ""){
            //here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;  //unique image name

            //save image to local directory
            $image->move(public_path('uploads/students'), $imageName);

            //save image in Database
            $student->image = $imageName;
            $student->save();
        }


        return redirect()->route('student.index')->with('success', 'Product added successfully');
    }

    //this method is responsible for editting student
    public function edit($id){

        $student = Student::findOrFail($id);
        return view('student.edit',[
            'student' => $student
        ]);

    }

    //this method is responsible for updating student
    public function update($id, Request $request){
        $student = Student::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'email' => 'required',
            'age' => 'required|numeric:2'
        ];

        if($request ->image != ""){
            $rules['image'] = 'image';
        }

        $validation = Validator::make($request->all(), $rules);

        if($validation -> fails()){
            return redirect()->route('student.edit', $student->id)->withInput()->withErrors($validation);
        }

        //updated student info from here=============
        // $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->age = $request->age;
        $student->description = $request->description;
        $student->save();


        if($request ->image != ""){

            //delete old image from local folder
            File::delete(public_path('uploads/students/'.$student->image));

            //here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;  //unique image name

            //save image to local directory
            $image->move(public_path('uploads/students'), $imageName);

            //save image in Database
            $student->image = $imageName;
            $student->save();
        }


        return redirect()->route('student.index')->with('success', 'Student updated successfully');

    }

    //this method is responsible for deleting student
    public function destroy($id){

        $student = Student::findOrFail($id);

        //delete old image from local folder
        File::delete(public_path('uploads/students/'. $student->image));

        //delete student from database
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student Deleted successfully');

    }
}
