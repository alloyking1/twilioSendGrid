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

        $from = new \SendGrid\Mail\From($validated['senderEmail']);

        /* Add email array from db to the mailing list */
        $receivers = EmailListing::all();

        /* Sent subject of mail */
        $subject = new \SendGrid\Mail\Subject($validated['emailTopic']);

        /* Set mail body */
        $htmlContent = new \SendGrid\Mail\HtmlContent($validated['emailBody']);

        $email = new \SendGrid\Mail\Mail(
            $from,
            $receivers,
            $subject,
            null,
            $htmlContent
        );

        return response()->json($mail);

        /* Create instance of Sendgrid SDK */
        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

        /* Send mail using sendgrid instance */
        $response = $sendgrid->send($email);
        if ($response->statusCode() == 202) {
            return back()->with(['success' => "E-mails successfully sent out!!"]);
        }

        return back()->withErrors(json_decode($response->body())->errors);
    }

}
