<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\AdmisssionApplication;
use App\Course;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Gender;
use App\Religion;
use App\Category;
use App\Otp;
class AdmisssionApplicationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * store stores the application for first time
     */
    public function store(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        $validator = \Validator::make($request->all(), [
            'courseId'=>'required',
        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/boards')
                        ->withErrors($validator)
                        ->withInput();
        }

		try {
		    $decrypted_courseId = decrypt($request->input('courseId'));
        	$student_id=Auth::guard('student')->user()->id;
        	$student_name=Auth::guard('student')->user()->name;
        	$course_details=Course::find($decrypted_courseId);

        	if($course_details){
        		DB::transaction(function () use ($course_details, $student_id,$student_name) {
        			/*Transaction Start*/
			        $AdmisssionApplication = new AdmisssionApplication([
			            'course_record_id' => $course_details->id,
			            'student_id' => $student_id,
			            'name' => $student_name
			        ]);
	        		$AdmisssionApplication->save();
	        	/*Update Student Where_am_i to next step ie 1*/
	            $student_update = Student::find($student_id);
        		$student_update->where_am_i = 1;
        		$student_update->save();

        		});/*Transaction End*/
        	Log::info(__CLASS__."::".__FUNCTION__." Saved");
        	return redirect('/student');
        	}
            Log::error(__CLASS__."::".__FUNCTION__." Course Found Failed");
            $exception_error=array("Course Could Not Be Found or Invalid!");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();       	

		} catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Course selection failed due to the use on an Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
		}
    }
    /*Agree to instructions*/
        public function UpdateAgree(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        $validator = \Validator::make($request->all(), [
            'instruction_agree'=>'required',
        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/student')
                        ->withErrors($validator)
                        ->withInput();
        }
        DB::transaction(function (){
                /*Update Student Where_am_i to next step ie 2*/
                $student_id=Auth::guard('student')->user()->id;
                $student_update = Student::find($student_id);
                $student_update->where_am_i = 2;
                $student_update->save();
            });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__."Instruction Agreed");
            return redirect('/student');
    }
    /*Update Personal Details*/
    public function UpdatePersonal(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        $validator = \Validator::make($request->all(), [
                    'flowKeyCooTect'=>'required',
                    'Student_Name'=>'required',
                    'Student_DOB'=>'required | date',
                    'Student_Gender'=>'required',
                    'Student_Caste'=>'required',
                    'Student_Religion'=>'required',
                    'Student_Nationality'=>'required',
                    'checkBPL'=>'nullable',
                    'checkPWD'=>'nullable',
                    'Student_Address'=>'required',
                    'Student_City'=>'required',
                    'Student_State'=>'required',
                    'Student_Pincode'=>'required',
                    'Father_Name'=>'required',
                    'Father_Job'=>'required',
                    'Father_Contact'=>'required',
                    'Mother_Name'=>'required',
                    'Mother_Job'=>'nullable',
                    'Mother_Contact'=>'nullable',
                    'Guardian_Name'=>'nullable',
                    'Guardian_Job'=>'nullable',
                    'Guardian_Contact'=>'nullable'
        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/student')
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $decrypted_Student_Gender = decrypt($request->input('Student_Gender'));
            $decrypted_Student_Caste = decrypt($request->input('Student_Caste'));
            $decrypted_Student_Religion = decrypt($request->input('Student_Religion'));
            $decrypted_flowKeyCooTect = decrypt($request->input('flowKeyCooTect'));
            if($request->input('checkBPL'))
                $check_checkBPL = 1;
            else
                $check_checkBPL = 0;

            if($request->input('checkPWD'))
                $check_checkPWD = 1;
            else
                $check_checkPWD = 0;
            /*Transaction Start*/
            DB::transaction(function () use ($check_checkBPL,$check_checkPWD,$decrypted_Student_Gender,$decrypted_Student_Caste,$decrypted_Student_Religion,$decrypted_flowKeyCooTect,$request){
                    /*Start Update Application Record*/
                    $application_record = AdmisssionApplication::find($decrypted_flowKeyCooTect);
                    $application_record->name = $request->input('Student_Name');
                    $application_record->dob = $request->input('Student_DOB');
                    $application_record->gender_record_id = $decrypted_Student_Gender;
                    $application_record->caste_record_id = $decrypted_Student_Caste;
                    $application_record->religion_record_id = $decrypted_Student_Religion;
                    $application_record->nationality = $request->input('Student_Nationality');
                    $application_record->checkBPL = $check_checkBPL;
                    $application_record->checkPWD = $check_checkPWD;
                    $application_record->address = $request->input('Student_Address');
                    $application_record->city = $request->input('Student_City');
                    $application_record->state = $request->input('Student_State');
                    $application_record->pincode = $request->input('Student_Pincode');
                    $application_record->father_name = $request->input('Father_Name');
                    $application_record->father_occupation = $request->input('Father_Job');
                    $application_record->father_contact = $request->input('Father_Contact');
                    $application_record->mother_name = $request->input('Mother_Name');
                    $application_record->mother_occupation = $request->input('Mother_Job');
                    $application_record->mother_contact = $request->input('Mother_Contact');
                    $application_record->guardian_name = $request->input('Guardian_Name');
                    $application_record->guardian_occupation = $request->input('Guardian_Job');
                    $application_record->guardian_contact = $request->input('Guardian_Contact');
                    $application_record->save();
                    /*End Update Application Record*/

                    /*Update Student Where_am_i to next step ie 3*/
                    $student_id = Auth::guard('student')->user()->id;
                    $student_update = Student::find($student_id);
                    $student_update->where_am_i = 3;
                    $student_update->save();
                });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__."Personal Details Filled");
            return redirect('/student');
        } catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Course selection failed due to the use on an Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
        }
    }

    /*Update Personal Details*/
    public function UpdateProfessional(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        $validator = \Validator::make($request->all(), [
                    'flowKeyCooTect'=>'required',
                    'HS_Board'=>'required',
                    'HS_Pass_Year'=>'required',
                    'HS_Division'=>'required',
                    'HS_Percentage'=>'required|integer|between:1,100',
                    'HSLC_Board'=>'required',
                    'HSLC_Pass_Year'=>'required',
                    'HSLC_Division'=>'required',
                    'HSLC_Percentage'=>'required|integer|between:1,100',
                    'HS_Subjects'=>'required',
                    'HS_Full_Marks'=>'required',
                    'HS_Got_Marks'=>'required'

        ]);
        //dd($request);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/student')
                        ->withErrors($validator)
                        ->withInput();
        }
        if(sizeof($request->input('HS_Subjects'))!=6 || sizeof($request->input('HS_Full_Marks'))!=6 || sizeof($request->input('HS_Got_Marks'))!=6)
        {
            Log::error(__CLASS__."::".__FUNCTION__." Subject Validation Failed");
            $sub_error=array('Enter Details of All HS Subjects');
            return redirect('/student')
                        ->withErrors($sub_error)
                        ->withInput();            
        }else{
            $hs_full_marks=$request->input('HS_Full_Marks');
            $hs_got_marks=$request->input('HS_Got_Marks');
            $hs_subjects=$request->input('HS_Subjects');
            for($count=0;$count<6;$count++){
                if($hs_got_marks[$count] == null || $hs_full_marks[$count] == null || $hs_subjects[$count] == null){
                Log::error(__CLASS__."::".__FUNCTION__." Not NULL Validation Failed");
                $sub_error=array('Subject Details must be Valid');
                return redirect('/student')
                            ->withErrors($sub_error)
                            ->withInput();                        
                }
                if($hs_got_marks[$count]<0 || $hs_full_marks[$count]<0){
                Log::error(__CLASS__."::".__FUNCTION__." Marks Validation Failed");
                $sub_error=array('Marks must be Integer');
                return redirect('/student')
                            ->withErrors($sub_error)
                            ->withInput();                        
                }
                if($hs_got_marks[$count]>$hs_full_marks[$count]){
                Log::error(__CLASS__."::".__FUNCTION__." Marks Validation Failed");
                $sub_error=array('Student Marks Cannot be Higher than Total Marks');
                return redirect('/student')
                            ->withErrors($sub_error)
                            ->withInput();                      
                }
            }
        }
        try {
            $decrypted_HS_Board = decrypt($request->input('HS_Board'));
            $decrypted_HSLC_Board = decrypt($request->input('HSLC_Board'));
            $decrypted_flowKeyCooTect = decrypt($request->input('flowKeyCooTect'));
            /*Transaction Start*/
            DB::transaction(function () use ($decrypted_HS_Board,$decrypted_HSLC_Board,$decrypted_flowKeyCooTect,$request){
                    /*Start Update Application Record*/
                    $application_record = AdmisssionApplication::find($decrypted_flowKeyCooTect);
                    $application_record->hs_board_record_id = $decrypted_HS_Board;                 
                    $application_record->hs_pass_year = $request->input('HS_Pass_Year');
                    $application_record->hs_division = $request->input('HS_Division');
                    $application_record->hs_percentage = $request->input('HS_Percentage');
                    $application_record->hs_subjects = implode(",",$request->input('HS_Subjects'));
                    $application_record->hs_total_marks = implode(",",$request->input('HS_Full_Marks'));
                    $application_record->hs_student_marks = implode(",",$request->input('HS_Got_Marks')); 

                    $application_record->hslc_board_record_id = $decrypted_HSLC_Board;

                    $application_record->hslc_pass_year = $request->input('HSLC_Pass_Year');
                    $application_record->hslc_division = $request->input('HSLC_Division');
                    $application_record->hslc_percentage = $request->input('HSLC_Percentage');
                    $application_record->save();
                    /*End Update Application Record*/

                    /*Update Student Where_am_i to next step ie 4*/
                    $student_id = Auth::guard('student')->user()->id;
                    $student_update = Student::find($student_id);
                    $student_update->where_am_i = 4;
                    $student_update->save();
                });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__."Professional Details Filled");
            return redirect('/student');
        } catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Course selection failed due to the use on an Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
        }
    }
    public function UpdateUpload(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
            $validator = \Validator::make($request->all(), [
                'flowKeyCooTect'=>'required',
                'Photo' => 'nullable|image|mimes:jpeg,png,jpg|max:150',
                'Signature' => 'nullable|image|mimes:jpeg,png,jpg|max:150',
                'HS_Certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:250',
                'HSLC_Certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:250',
                'Age_Certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:250',
                'Caste_Certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:250'
            ]);

            if ($validator->fails()) {
                Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
                return redirect('/student')
                            ->withErrors($validator)
                            ->withInput();
            }

        try {

            $decrypted_flowKeyCooTect = decrypt($request->input('flowKeyCooTect'));
            $temp_application_record = AdmisssionApplication::find($decrypted_flowKeyCooTect);
            /*Verify files and delete earlier entries*/
                $stored_Photo=$temp_application_record->file_photo;

                if ($request->hasFile('Photo')) {
                    //Delete the OLD photo
                    Storage::delete($temp_application_record->file_photo);
                    //Save the NEW photo
                    $path = $request->Photo->store('student_files');
                    $stored_Photo=$request->Photo->hashName();
                    }

                $stored_Signature=$temp_application_record->file_signature;

                if ($request->hasFile('Signature')) {
                    //Delete the OLD Signature
                    Storage::delete($temp_application_record->file_signature);
                    //Save the NEW Signature
                    $path = $request->Signature->store('student_files');
                    $stored_Signature=$request->Signature->hashName();
                    }

                $stored_HS=$temp_application_record->file_hs;

                if ($request->hasFile('HS_Certificate')) {
                    //Delete the OLD HS
                    Storage::delete($temp_application_record->file_hs);
                    //Save the NEW HS
                    $path = $request->HS_Certificate->store('student_files');
                    $stored_HS=$request->HS_Certificate->hashName();
                    }

                $stored_HSLC=$temp_application_record->file_hslc;

                if ($request->hasFile('HSLC_Certificate')) {
                    //Delete the OLD HSLC
                    Storage::delete($temp_application_record->file_hslc);
                    //Save the NEW HSLC
                    $path = $request->HSLC_Certificate->store('student_files');
                    $stored_HSLC=$request->HSLC_Certificate->hashName();
                    }

                $stored_Age=$temp_application_record->file_dob;

                if ($request->hasFile('Age_Certificate')) {
                    //Delete the OLD Age
                    Storage::delete($temp_application_record->file_dob);
                    //Save the NEW Age
                    $path = $request->Age_Certificate->store('student_files');
                    $stored_Age=$request->Age_Certificate->hashName();
                    }

                $stored_Caste=$temp_application_record->file_caste;

                if ($request->hasFile('Caste_Certificate')) {
                    //Delete the OLD Caste
                    Storage::delete($temp_application_record->file_caste);
                    //Save the NEW Caste
                    $path = $request->Caste_Certificate->store('student_files');
                    $stored_Caste=$request->Caste_Certificate->hashName();
                    }
            /*End files and delete earlier entries*/

            /*Transaction Start*/
            DB::transaction(function () use ($decrypted_flowKeyCooTect,$stored_Photo,$stored_Signature,$stored_HS,$stored_HSLC,$stored_Age,$stored_Caste){
                    /*Start Update Application Record*/
                    $application_record = AdmisssionApplication::find($decrypted_flowKeyCooTect);
                    $application_record->file_photo = $stored_Photo;
                    $application_record->file_signature = $stored_Signature;
                    $application_record->file_hs = $stored_HS;
                    $application_record->file_hslc = $stored_HSLC;
                    $application_record->file_dob = $stored_Age;
                    $application_record->file_caste = $stored_Caste;
                    $application_record->save();
                    /*End Update Application Record*/

                    /*Update Student Where_am_i to next step ie 5*/
                    $student_id = Auth::guard('student')->user()->id;
                    $student_update = Student::find($student_id);
                    $student_update->where_am_i = 5;
                    $student_update->save();
                });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__."Files Uploaded");
            return redirect('/student');
        } catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Course selection failed due to the use on an Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
        }     
        
    }
    /*Go to Step 2*/
        public function UpdateEdit(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        DB::transaction(function (){
                /*Update Student Where_am_i to next step ie 2*/
                $student_id=Auth::guard('student')->user()->id;
                $student_update = Student::find($student_id);
                $student_update->where_am_i = 2;
                $student_update->save();
            });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__."Instruction Agreed");
            return redirect('/student');
    }

    /*Update Subjects Details*/
    public function UpdateSubjects(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        $validator = \Validator::make($request->all(), [
                    'flowKeyCooTect'=>'required',
                    'major'=>'nullable',
                    'elective'=>'nullable',
                    'instruction_agree'=>'required'
        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/student')
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $decrypted_major=array();
            if($request->input('major')){
                foreach($request->input('major') AS $one_major)
                {
                    $one_major=decrypt($one_major);
                    array_push($decrypted_major,$one_major); 
                    
                }
        }
            $decrypted_elective=array();
            if($request->input('elective')){
                foreach($request->input('elective') AS $one_elective)
                {
                    $one_elective=decrypt($one_elective);
                    array_push($decrypted_elective,$one_elective); 
                    
                }
        }
            $decrypted_flowKeyCooTect = decrypt($request->input('flowKeyCooTect'));
            $check_upload_pass=0;         
            $temp_application_record = AdmisssionApplication::find($decrypted_flowKeyCooTect);
            /*This ID will be sent to a job to generate application number*/
            $application_course_id_job=$temp_application_record->course_record_id;
            $application_application_id_job=$decrypted_flowKeyCooTect;
            /*./This ID will be sent to a job to generate application number*/

            if($temp_application_record->caste_record_id == env('GENERAL_CASTE_ID') && $temp_application_record->checkBPL== 0 && $temp_application_record->checkPWD == 0)//General or pwd or bpl
            {
                if($temp_application_record->file_photo && $temp_application_record->file_signature && $temp_application_record->file_hs && $temp_application_record->file_hslc && $temp_application_record->file_dob){
                    $check_upload_pass = 1; //All Files Present
                }
            }
            else
            {
                if($temp_application_record->file_photo && $temp_application_record->file_signature && $temp_application_record->file_hs && $temp_application_record->file_hslc && $temp_application_record->file_dob && $temp_application_record->file_caste){
                    $check_upload_pass = 1; //All Files Present
                }
            }
            if($check_upload_pass == 0){
            Log::error(__CLASS__."::".__FUNCTION__." File Upload Missing");
            $exception_error=array("You have not uploaded all the required documents.Please upload them and try again!");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
            }
            /*Transaction Start*/
            DB::transaction(function () use ($decrypted_major,$decrypted_elective,$decrypted_flowKeyCooTect){
                    /*Start Update Application Record*/
                    $application_record = AdmisssionApplication::find($decrypted_flowKeyCooTect);

                    /*Generate Application No.*/
/*                        $course_record = Course::find($application_record->course_record_id);
                        $application_id_tail=sprintf(env('SPRINTF_PAD'), $course_record->course_counter);
                        $application_id = $course_record->course_prefix."-".$application_id_tail;
                         $course_record->course_counter = $course_record->course_counter+1;
                         $course_record->save();
                     
                    $application_record->application_id = $application_id;*/
                    /*End Generate Application No.*/
                    $application_record->major = implode(",",$decrypted_major);
                    $application_record->elective = implode(",",$decrypted_elective);
                    $application_record->status = 1;
                    $application_record->save();
                    /*End Update Application Record*/

                    /*Update Student Where_am_i to next step ie 6*/
                    $student_id = Auth::guard('student')->user()->id;
                    $student_update = Student::find($student_id);
                    $student_update->where_am_i = 6;
                    $student_update->save();
                });/*Transaction End*/

            dispatch(new \App\Jobs\generateApplicationNumber($application_course_id_job,$application_application_id_job));
            Log::info(__CLASS__."::".__FUNCTION__."Subject Filled and Confirmed");
            return redirect('/student');
        } catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Course selection failed due to the use on an Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
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
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        try{
            $decrypted_id=decrypt($id);
        $student_courses=DB::select('SELECT application_record.*,gender_record.name as gender_record_name,category_record.name as category_record_name,religion_record.name as religion_record_name,hsboard.name as hs_board_name,hslcboard.name as hslc_board_name FROM `application_record` 
LEFT JOIN gender_record on gender_record.id=application_record.gender_record_id
LEFT JOIN category_record on category_record.id=application_record.caste_record_id
LEFT JOIN religion_record on religion_record.id=application_record.religion_record_id
LEFT JOIN board_record as hsboard on hsboard.id=application_record.hs_board_record_id
LEFT JOIN board_record as hslcboard on hslcboard.id=application_record.hslc_board_record_id
WHERE application_record.application_id=? AND student_id=?',[$decrypted_id,Auth::guard('student')->user()->id]);
        
        foreach($student_courses AS $student_course){
            break;
        }
            $course_list=Course::find($student_course->course_record_id);
            $storage_path="anotherstorage";
        /*return view('pdfbody.displayApplication',compact('student_course','course_list','storage_path'));*/
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'dpi' => 150,'setPaper'=>'A4'])->loadView('pdfbody.pdfDisplayApplication', compact('student_course','storage_path','course_list'));
        return $pdf->stream('Application '.$student_course->application_id.'.pdf');
        }catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Unverified Method");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
                        
        }
    }

    public function generateOTP() {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
                $new_otp=mt_rand(100000, 999999);
                DB::transaction(function () use($new_otp){
                    /*Transaction Start*/
                    
                    $Otp = new Otp([
                        'otp' => $new_otp,
                        'student_id'=>Auth::guard('student')->user()->id
                    ]);
                    $Otp->save();
                /*Update Student Where_am_i to next step ie 98*/
                $student_update = Student::find(Auth::guard('student')->user()->id);
                $student_update->where_am_i = 98;
                $student_update->save();

                });/*Transaction End*/
            dispatch(new \App\Jobs\SendOTPSMS(Auth::guard('student')->user()->id));
            Log::info(__CLASS__."::".__FUNCTION__." Saved");
            return redirect('/student')->with('success','OTP Sent Succesfully'); 
    }
    public function verifyOTP(Request $request) {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
        $validator = \Validator::make($request->all(), [
                    'otp_value'=>'required'
        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/student')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $data=Otp::where("student_id","=",Auth::guard('student')->user()->id)->get();
        foreach($data AS $obj)
        {
            break;
        }
        if($obj->otp != $request->input('otp_value')){
            Log::error(__CLASS__."::".__FUNCTION__." OTP Verification Failed");
            $exception_error=array("OTP Verification Failed");
            return redirect('/student')
                        ->withErrors($exception_error)
                        ->withInput();
        }
                DB::transaction(function (){
                    /*Transaction Start*/
                /*Update Student Where_am_i to next step ie 0 course selection*/
                $student_update = Student::find(Auth::guard('student')->user()->id);
                $student_update->where_am_i = 0;
                $student_update->save();

                });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__." Saved");
            return redirect('/student')->with('success','Mobile Verified Succesfully'); 
    }
    public function resendOTP() {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".Auth::guard('student')->user()->id);
                $data=Otp::where("student_id","=",Auth::guard('student')->user()->id)->get();
                foreach($data AS $obj)
                {
                    break;
                }
                if($obj->counter >= 4){
                    Log::error(__CLASS__."::".__FUNCTION__." OTP Verification Failed");
                    $exception_error=array("Maximum 3 OTPs allowed");
                    return redirect('/student')
                                ->withErrors($exception_error)
                                ->withInput();
                }
                $new_otp=mt_rand(100000, 999999);
                DB::transaction(function () use($obj,$new_otp){
                    /*Transaction Start*/
                    
                    $obj->otp=$new_otp;
                    $obj->counter=$obj->counter+1;
                    $obj->save();

                });/*Transaction End*/
            dispatch(new \App\Jobs\SendOTPSMS(Auth::guard('student')->user()->id));
            Log::info(__CLASS__."::".__FUNCTION__." Saved");
            return redirect('/student')->with('success','OTP Sent Succesfully'); 
    }
}