<?php

namespace ContactForm\Libs\ValidatorService;

interface ValidatorInterface
{
    public function validate($value, $argument = '');
}
