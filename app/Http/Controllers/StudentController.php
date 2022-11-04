<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\StudentSport;
use App\Models\StudentSports;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::with('student_sports')->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $newStudent =new Student;
        $newStudent->first_name   = $request->first_name;
        $newStudent->last_name    = $request->last_name;
        $newStudent->email        = $request->email;
        $newStudent->dob          = $request->dob;
        $newStudent->phone_number = $request->phone_number;

        try {

            $newStudent->save();

            if ($request->sports) {
                foreach ($request->sports as $sport_id) {
                    $studentSport = new StudentSports;
                    $studentSport->student_id = $newStudent->id;
                    $studentSport->sport_id   = $sport_id;

                    $studentSport->save();
                }
            }
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }

        return response(Student::with('student_sports')->find($newStudent->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            try {
                $requestData = $request->all();

                if ($requestData['sports']) {
                    StudentSports::where('student_id', $id)->delete();

                    foreach ($requestData['sports'] as $sport_id) {
                        $studentSport = new StudentSports;
                        $studentSport->student_id = $id;
                        $studentSport->sport_id   = $sport_id;

                        $studentSport->save();
                    }

                    unset($requestData['sports']);
                }

                foreach ($requestData as $field => $value) {
                    $student->{$field} = $value;
                }
                $student->save();

                return response(Student::with('student_sports')->find($id));
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()]);
            }

        }

        return response(['error' => "Student doesn't exist"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            try {
                $student->delete();

                return response('Deleted');
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
        }

        return response(['error' => "Student doesn't exist"]);
    }
}
