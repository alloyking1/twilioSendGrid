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
            $receivers2 = [$address->email => "this is a test"];
            // $receivers[] = $receivers2;
        }

        // return $receivers;

        // $tos = [
        //         "alloyking1@gmail.com" => "Example User1",
        //         "alloyking1@yahoo.com" => "Example User2",
        //     ];
            

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($from, "alloy");
        $email->setSubject($topic);
        // $email->addTo("alloyking1@gmail.com", "Example User");
        $email->addTos($receivers2);
        $email->addContent("text/plain", $emailContent);
        
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

        try {
            $response = $sendgrid->send($email);
            return response()->json("Email sent successfully");

        } catch (Exception $e) {
            return response()->json( 'Caught exception: '. $e->getMessage() ."\n");
        }








        $from = new \SendGrid\Mail\From($validated['senderEmail']);

        /* Add email array from db to the mailing list */
        $receivers = EmailListing::all();
        foreach ($receivers as $key){

            /* Sent subject of mail */
            $subject = new \SendGrid\Mail\Subject($validated['emailTopic']);

            /* Set mail body */
            $htmlContent = new \SendGrid\Mail\HtmlContent($validated['emailBody']);

            $email = new \SendGrid\Mail\Mail(
                $from,
                $key->email,
                $subject,
                null,
                $htmlContent
            );

            return $response = $sendgrid->send($email);
        }

        // /* Sent subject of mail */
        // $subject = new \SendGrid\Mail\Subject($validated['emailTopic']);

        // /* Set mail body */
        // $htmlContent = new \SendGrid\Mail\HtmlContent($validated['emailBody']);

        // $email = new \SendGrid\Mail\Mail(
        //     $from,
        //     $receivers,
        //     $subject,
        //     null,
        //     $htmlContent
        // );

        // /* Create instance of Sendgrid SDK */
        // $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

        /* Send mail using sendgrid instance */
        // return $response = $sendgrid->send($email);
        // if ($response->statusCode() == 202) {
        //     return back()->with(['success' => "E-mails successfully sent out!!"]);
        // }

        // return back()->withErrors(json_decode($response->body())->errors);
    }

}
