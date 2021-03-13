<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailListing;
use SendGrid;

class EmailListingController extends Controller
{
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
            if(count($receivers) === 0){
                $receivers = [$address->email => "this is the first"];
            }else{
                array_push($receivers, $address->email);
            }
            // $receivers[] = $receivers2;
            // array_push($receivers, [$address->email=>"this is a test"]);
            // $receivers = array($address->email=>"this is a test");
        }
        // $sum = 0;
        // do{
        //     $sum ++;
        //     array_push($receivers, [$addresses->email => "this is a test"]);
        // }while ($sum < count($addresses));

        print_r($receivers);
        return $receivers;

        // $tos = [
        //         "alloyking1@gmail.com" => "Example User1",
        //         "alloyking1@yahoo.com" => "Example User2",
        //     ];

        // return $receivers;
        // return $tos;

        
            

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
