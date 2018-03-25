<?php

namespace Libs\ValidatorService;

class Labels
{
    public function getInputLabels()
    {
        return [
            'firstname' => 'imię',
            'lastname' => 'nazwisko',
            'email' => 'E-mail',
            'content' => 'treść',
        ];
    }
}
