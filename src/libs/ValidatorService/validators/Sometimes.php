<?php

namespace Libs\ValidatorService\Validators;

use Libs\ValidatorService\ValidatorInterface;

class Sometimes implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return true;
    }
}
