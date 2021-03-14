<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailListing;
use SendGrid;

class EmailListingController extends Controller
{
    protected function array_push_assoc(&$array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    public function sendEMail(Request $request)
    {

        $validated = $request->validate([
            'emailTopic' => 'required|string',
            'emailBody' => 'required|string',
            'senderEmail' => 'required|email',
        ]);

        $from = $validated['senderEmail'];
        $topic = $validated['emailTopic'];
        $addresses = EmailListing::all();
        $receivers = [];
        $emailContent = $validated['emailBody'];

        

        foreach($addresses as $address){
            $this->array_push_assoc($receivers, $address->email, 'Example user ');
        }

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($from, "alloy");
        $email->setSubject($topic);
        $email->addTo("alloyking1@gmail.com", "Example User");
        $email->addTos($receivers);
        $email->addContent("text/plain", $emailContent);
        
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

        try {
            $response = $sendgrid->send($email);
            return response()->json("Email sent successfully");

        } catch (Exception $e) {
            return response()->json( 'Caught exception: '. $e->getMessage() ."\n");
        }

    }

}
