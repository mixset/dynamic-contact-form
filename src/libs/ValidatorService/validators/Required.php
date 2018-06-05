<?php

namespace ContactForm\Libs\ValidatorService\Validators;

use ContactForm\Libs\ValidatorService\ValidatorInterface;

class Required implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return empty($value) === false;
    }
}
