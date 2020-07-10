<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Log;
use DB;
use App\Course;
use App\AdmisssionApplication;
class adminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        //$admin_students = Student::all();
        $admin_students=DB::select("select students.*,application_record.application_id,application_record.id as app_primary_id,application_record.status as app_status from students left join application_record on application_record.student_id=students.id");
        return view('admin_students.index',compact('admin_students'));
    }
    public function getSMSBalance()
    {
            $curl = curl_init();

            $apiKey=env('PNGSMS_API_KEY'); //Enter The API Key Here
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.pingsms.in/api/getsmsbalance?key=".$apiKey,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "X-Authorization: ".$apiKey
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return $response;

/*            if ($err) {
              return $err;
            } else {
              $data = json_decode($response);
              return $data;
          }*/

              //$data = json_decode($response); //convert the response to object 
              //echo $data->available_balance->transactional_balance; //Echo out transactional balance  
    }  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $validator = \Validator::make($request->all(), [
            'status'=>'required',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/admin_students')
                        ->withErrors($validator)
                        ->withInput();
        }
        $admission = AdmisssionApplication::find($id);
        $student = Student::find($admission->student_id);
        $student->course_record_id = $admission->course_record_id;
        $admission->status =  $request->get('status');
        $admission->save();
        Log::info(__CLASS__."::".__FUNCTION__." $id Updated");
        if($request->get('status')=='2'){
            $student->course_semester = '1';
            $student->save();
            dispatch(new \App\Jobs\SendStudentSMS($id,"accepted"));
            return redirect('/admin_students')->with('success', 'Student Application Accepted!');
            
        }
        else{
            $student->course_semester = '0';
            $student->save();
            dispatch(new \App\Jobs\SendStudentSMS($id,"rejected"));
            return redirect('/admin_students')->with('success', 'Student Application Rejected!');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        Log::debug("Delete Student $id");
        $student = Student::find($id);
        $student->delete();
        Log::info(__CLASS__."::".__FUNCTION__." $id Student Deleted");
        return redirect('/admin_students')->with('success', 'Student deleted!');
    }
    /*This function is a copy of AdmisssionApplicationController::show($id)*/
    public function showStudentApplication($id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        try{
            $decrypted_id=decrypt($id);
        $student_courses=DB::select('SELECT application_record.*,gender_record.name as gender_record_name,category_record.name as category_record_name,religion_record.name as religion_record_name,hsboard.name as hs_board_name,hslcboard.name as hslc_board_name FROM `application_record` 
LEFT JOIN gender_record on gender_record.id=application_record.gender_record_id
LEFT JOIN category_record on category_record.id=application_record.caste_record_id
LEFT JOIN religion_record on religion_record.id=application_record.religion_record_id
LEFT JOIN board_record as hsboard on hsboard.id=application_record.hs_board_record_id
LEFT JOIN board_record as hslcboard on hslcboard.id=application_record.hslc_board_record_id
WHERE application_record.application_id=?',[$decrypted_id]);
        
        foreach($student_courses AS $student_course){
            break;
        }
            $course_list=Course::find($student_course->course_record_id);
            $storage_path="myadminstorage";

        return view('pdfbody.displayApplication',compact('student_course','course_list','storage_path'));
/*        $pdf = \PDF::loadView('pdfbody.displayApplication', compact('student_course'));
        return $pdf->stream('invoice.pdf');*/

        }catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
        }
    }
}
