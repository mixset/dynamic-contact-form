<?php

namespace Libs\ValidatorService\Validators;

use Libs\ValidatorService\ValidatorInterface;

class Required implements ValidatorInterface
{
    public function validate($value, $argument = '')
    {
        return empty($value) === false;
    }
}
