<?php

function sendEmail($config)
{
    $email = service("email");

    try {
        $email->setFrom($config['mailFromEmail'], $config['mailFromName']);
        $email->setTo($config['mailRecepientEmail'], $config['mailRacepientName']);
        $email->setSubject($config['mailSubject']);
        $email->setMessage($config['mailBody']);
        if ($email->send()) {
            return true;
        }


        log_message('error', 'Email gagal dikirim ke: ' . $config['mailRecepientEmail'] . '. Error: ' . $email->printDebugger(['headers']));
        return false;
    } catch (\Exception $e) {
        log_message('error', 'Exception saat mengirim email: ' . $e->getMessage());
        return false;
    }
}
