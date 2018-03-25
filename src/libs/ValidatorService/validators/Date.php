<?php

namespace Libs\ValidatorService\Validators;

use Libs\ValidatorService\ValidatorInterface;

class Date implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        if ((!is_string($value) && !is_numeric($value)) || strtotime($value) === false) {
            return false;
        }

        $date = date_parse($value);

        return checkdate($date['month'], $date['day'], $date['year']);
    }
}
