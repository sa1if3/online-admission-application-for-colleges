<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\AdmisssionApplication;
use App\Student;

class SendStudentSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    protected $details;
    protected $msg;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details,$msg)
    {
        $this->details = $details;
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admission=AdmisssionApplication::find($this->details);
        $student=Student::find($admission->student_id);
        $curl = curl_init();

        $apiKey=env('PNGSMS_API_KEY'); //Enter The API Key Here
        $senderId=env('PNGSMS_SENDER_ID'); //Your SenderId. PNGSMS is default senderId
        $app_name=env('APP_NAME');
        $mobileNumber=$student->mobile; //10 digit phone number
        $language="1";
        $product="1";

        /*           
        Language:   1 - English, 2 - Unicode (Regional Language)
        Product :   1 - Transactional, 2 - Promotional
        */

        $message="Hello $student->name,
Your Application $admission->application_id has been $this->msg.
- $app_name";

        $message=urlencode($message);// Encode the message to send it through URL

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.pingsms.in/api/sendsms?key=".$apiKey."&sender=".$senderId."&mobile=".$mobileNumber."&language=".$language."&product=".$product."&message=".$message,
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

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }
}
