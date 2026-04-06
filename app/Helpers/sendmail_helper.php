<?php
function kirim_email($ci, $to, $title, $message)
{
    $ci->email = service('email');

    $ci->email->setFrom('noreply@nolimitstraining.id', 'noreply');
    $ci->email->setTo($to);
    $ci->email->setSubject($title);
    $ci->email->setMessage($message);

    if (!$ci->email->send()) {
        return false;
        $ci->email->clear();
        $ci->email->printDebugger();
    } else {
        return true;
    }
}
