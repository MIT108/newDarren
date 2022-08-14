<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailController extends Controller
{
    //
    public function sendMail($recipientName, $recipientEmail, $subject, $body)
    {

        $senderEmail = env('MAIL_SENDER_EMAIL');
        $senderPassword = env('MAIL_SENDER_PASSWORD');
        $senderName = env('MAIL_SENDER_NAME');
        $site = env('APP_URL');


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $senderEmail;                     //SMTP username
            $mail->Password   = $senderPassword;                               //SMTP password //jfltubgqbwniivya
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            $mail->SMTPDebug  = 0;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($senderEmail, $senderName);
            $mail->addAddress($recipientEmail);    //Name is optional
            $mail->addReplyTo($recipientEmail, $recipientName);

            // //Attachments
            // if (count($attachmentsArray) > 0) {
            //     $mail->addAttachment('/var/tmp/file.tar.gz');
            //     foreach ($attachmentsArray as $attachment) {
            //         $mail->addAttachment($attachment->path, $attachment->name);
            //     }
            // }
            // $logo = env('APP_URL')."/assets/image/logo.webp";

            $body = "<!DOCTYPE html>
            <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>

            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width,initial-scale=1'>
                <meta name='x-apple-disable-message-reformatting'>
                <title></title>
                <!--[if mso]>
              <noscript>
                <xml>
                  <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                  </o:OfficeDocumentSettings>
                </xml>
              </noscript>
              <![endif]-->
                <style>
                    table,
                    td,
                    div,
                    h1,
                    p {
                        font-family: Arial, sans-serif;
                    }

                </style>
            </head>

            <body style='margin:0;padding:0;'>
                <table role='presentation'
                    style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
                    <tr>
                        <td align='center' style='padding:0;'>
                            <table role='presentation'
                                style='width:602px;border-collapse:collapse;border:1px solid blue;border-spacing:0;text-align:left; margin: 10px'>
                                <tr>
                                    <td align='center' style='padding:40px 0 30px 0;background:#ffffff;'>
                                        <h1>$senderName</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='padding:36px 30px 42px 30px;'>
                                        <table role='presentation'
                                            style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                            <tr>
                                                <td style='padding:0 0 36px 0;color:#153643;'>
                                                    <h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>
                                                        $subject</h1>
                                                    <p
                                                        style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>
                                                        $body</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>

            </html>


            ";
            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
