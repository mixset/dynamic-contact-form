<?php

namespace ContactForm\Libs\ValidatorService\Validators;

use ContactForm\Libs\ValidatorService\ValidatorInterface;

class Sometimes implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return true;
    }
}
