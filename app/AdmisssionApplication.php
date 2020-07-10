<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmisssionApplication extends Model
{
	protected $table = 'application_record';

    protected $fillable = [
		'application_id',
		'course_record_id',
		'student_id',
		'name',
		'dob',
		'gender_record_id',
		'caste_record_id',
		'religion_record_id',
		'nationality',
		'address',
		'city',
		'state',
		'pincode',
		'father_name',
		'father_occupation',
		'father_contact',
		'mother_name',
		'mother_occupation',
		'mother_contact',
		'guardian_name',
		'guardian_occupation',
		'guardian_contact',
		'hs_board_record_id',
		'hs_pass_year',
		'hs_division',
		'hs_percentage',
		'hslc_board_record_id',
		'hslc_pass_year',
		'hslc_division',
		'hslc_percentage',
		'file_photo',
		'file_signature',
		'file_hs',
		'file_hslc',
		'file_dob',
		'file_caste',
		'checkPWD',
		'checkBPL',
		'major',
		'elective',
		'complete_percentage',
		'status',
		'hs_subjects',
		'hs_total_marks',
		'hs_student_marks'
    ];
}
