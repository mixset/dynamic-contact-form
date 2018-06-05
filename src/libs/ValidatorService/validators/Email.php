<?php

namespace ContactForm\Libs\ValidatorService\Validators;

use ContactForm\Libs\ValidatorService\ValidatorInterface;

class Email implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
