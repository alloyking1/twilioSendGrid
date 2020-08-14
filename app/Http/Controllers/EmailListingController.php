<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailListingController extends Controller
{
    public function sendEMail(Request $request)
    {
        return response()->json('testing');
        // $validated = $request->validate([
        //     'from' => 'required|email',
        //     'users' => 'required|array',
        //     'users.*' => 'required',
        //     'subject' => 'required|string',
        //     'body' => 'required|string',
        // ]);

        // $from = new \SendGrid\Mail\From($validated['from']);

        // /* Add selected users email to $tos array */
        // $tos = [];
        // foreach ($validated['users'] as $user) {
        //     array_push($tos, new \SendGrid\Mail\To(json_decode($user)->email, json_decode($user)->name));
        // }

        // /* Sent subject of mail */
        // $subject = new \SendGrid\Mail\Subject($validated['subject']);

        // /* Set mail body */
        // $htmlContent = new \SendGrid\Mail\HtmlContent($validated['body']);

        // $email = new \SendGrid\Mail\Mail(
        //     $from,
        //     $tos,
        //     $subject,
        //     null,
        //     $htmlContent
        // );

        // /* Create instance of Sendgrid SDK */
        // $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

        // /* Send mail using sendgrid instance */
        // $response = $sendgrid->send($email);
        // if ($response->statusCode() == 202) {
        //     return back()->with(['success' => "E-mails successfully sent out!!"]);
        // }

        // return back()->withErrors(json_decode($response->body())->errors);
    }

}
