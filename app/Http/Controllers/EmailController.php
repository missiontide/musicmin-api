<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SendGrid\Mail\Mail;

class EmailController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function sendSongRequestEmail(Request $request): Response
    {
        $validated = $request->validate([
            'songTitle' => 'required|string',
            'songArtist' => 'required|string',
            'email' => 'required|email',
        ]);

        $email = new Mail();
        $email->setFrom('patcoronel@missiontide.com');
        $email->setSubject('Song Request from '.$request->email);
        $email->addTo('patcoronel@missiontide.com');
        $email->addContent('text/plain', $request->songArtist. ' - '.$request->songTitle);

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }

        return response();
    }
}
