<?php

namespace Libs\ValidatorService;

interface ValidatorInterface
{
    public function validate($value, $argument = '');
}
