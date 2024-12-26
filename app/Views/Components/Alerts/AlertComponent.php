<?php

namespace App\Views\Components\Alerts;

class AlertComponent
{
    public function render($type = 'success', $message = '')
    {
        return view('Components/Alerts/alert_view', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
