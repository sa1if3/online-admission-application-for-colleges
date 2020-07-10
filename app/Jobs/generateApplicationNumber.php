<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\AdmisssionApplication;
use App\Course;
use DB;

class generateApplicationNumber implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5;
    protected $details;//course_id
    protected $app_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$app_id)
    {
        $this->details = $details;
        $this->app_id = $app_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $course_id=$this->details;
        $app_id=$this->app_id;
        DB::transaction(function () use ($course_id,$app_id){
                        $course_record = Course::find($course_id);
                        $application_id_tail=sprintf(env('SPRINTF_PAD'), $course_record->course_counter);
                        $application_id = $course_record->course_prefix."-".$application_id_tail;
                        $course_record->course_counter = $course_record->course_counter+1;
                        $course_record->save();

                        $application_record = AdmisssionApplication::find($app_id);
                        $application_record->application_id = $application_id;
                        $application_record->save();
                });
    }
}
