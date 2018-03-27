<?php

namespace Libs\ValidatorService\Validators;

use Libs\ValidatorService\ValidatorInterface;

class Email implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
