<?php

namespace App\Validation;

class KelasValidation
{
    public function valid_time(string $str, string &$error = null): bool
    {
        if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $str)) {
            return true;
        } else {
            $error = 'The {field} field must contain a valid time (HH:MM).';
            return false;
        }
    }
}
