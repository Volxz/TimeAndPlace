<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Student;
use App\Course;

class StudentController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->except('showJSON');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        // dd($students->first());
        foreach ($students as $student) {
            print_r($student->studentID ." ... " . $student->lastname .', '.$student->firstname . " ... " . $student->loginID ."<br>");
            
        }  
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$db2 = \DB::connection('mysql2');
        //$courses = $db2->table('students')->find(1);
        //print_r($courses . '\n');

     

        // $student = new Student();
        
       //Student record
        // $record = $student->find($id) ??  abort(403,'Student ' .$id. ' not found.');
        $student = Student::find($id) ??  abort(403,'Student ' .$id. ' not found.');
        
        $photoURL = $student->getPhotoURL($id);
        $student->getTimeTable();    //NOT USED: $courses = $student->getTimeTable();

		//$student = $student->find($id);
        //$student = $student->first();
        $age = $this->getAge($student->dob);
        //return view('student')->withRecord($student)->withAge($age);
        return view('student', compact('record','age','photoURL'));
    
        //dd($student);
    }

    public function showJSON($id)
    {        
       //Student record
        $student = Student::find($id);
        if ($student == null) {
            $age = -1;
            $photoURL = "";
        } else {
            $photoURL = $student->getPhotoURL($id);
            $age = $this->getAge($student->dob);
        }
        
        return response()->json(['record' => $student, 'age'=> $age, 'photoURL'=>$photoURL]);    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCourse()
    {
        
        // $db2 = \DB::connection('mysql2');
        // $courses = $db2->table('courses')::all();//->find(1);
        
        $courses = Course::all();
       // $course = $courses->first();
       // dd($course->coursecode);

        foreach ($courses as $course) {
            print_r($course->coursecode ." ... " . $course->teacher . "<br>");
            // dd($course->first());
        }   
        
        //THIS WORKS: 
        // $kiosks = Kiosk::all();
        // foreach($kiosks as $kiosk) {
        //     print_r($kiosk);
        // }
        // dd('x');
    }

    //This method works
    private function getAge($then) {
        $then = date('Ymd', strtotime($then));
        $diff = date('Ymd') - $then;
        $age = substr($diff,0,-4);
        //try to get decimal years!
        //$age= sprintf("%u.%u",substr($diff, 0, 2),substr($diff,2,2));
        return $age;
    }
    
    //changes course name to look like this ESLAO1-01 (adds in hyphen)
    private function formatCourse($course) {
        if (strlen($course) != 8) return $course;

        $temp = substr($course,0,6) . "-" . substr($course,6);
        return $temp;
    }

    /* get courses .... 
    //get timetable
    $sql = "SELECT courses.coursecode, teacher, period, room FROM courses INNER JOIN student_course ON courses.coursecode = student_course.coursecode WHERE studentID = ? ORDER BY period";
    if ($stmt = $schoolDB->prepare($sql)) {
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        // save output into array of rows in $timetable 
        $timetable = $stmt->get_result();
        $stmt->close();
    }


     if ($timetable->num_rows == 0) {
        echo "<tr><td colspan=4> no timetable </td></tr>";
    } else {
        while ($row = mysqli_fetch_assoc($timetable)) {
            $coursecode = formatCourse($row['coursecode']);

            $text = "<td>".$row['period'] ."</td><td>". $coursecode ."</td><td>". $row['teacher'] ."</td><td>". $row['room'] . "</td>";
            echo "<tr>" . $text . "</tr>";
        }
    }

*/

/*
public function toggleStudent(Kiosk $kiosk, Student $student)
{
    $present = \App\StudentSignedIn::isSignedIn($student->studentID, $kiosk->id);
    // $present = $student->kiosks->contains($kiosk->id);
    if ($present) {
        //Add entry to logs
        //$kiosk->logs()->attach($student->id, ['type' => 'Kiosk Sign Out']);
        $kiosk->logs()->attach($student->id, ['type' => 'Sign Out']);

        //log the student out by deleting the record
        $student->kiosks()->detach($kiosk->id);

        //Return info for AJAX to display on the kiosk
        return response()->json(['status' => 'detached', 'student' => $student->toArray()]);
    } else {
        //Add entry to logs
        //$kiosk->logs()->attach($student->id, ['type' => 'Kiosk Sign In']);
        $kiosk->logs()->attach($student->id, ['type' => 'Sign In']);

        //log the student in
        $student->kiosks()->attach($kiosk->id);

        return response()->json(['status' => 'attached', 'student' => $student->toArray()]);
    }
}
*/
    
}
