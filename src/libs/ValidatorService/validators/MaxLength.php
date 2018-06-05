<?php

namespace ContactForm\Libs\ValidatorService\Validators;

use ContactForm\Libs\ValidatorService\ValidatorInterface;

class MaxLength implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return mb_strlen($value) > $argument === false;
    }
}
