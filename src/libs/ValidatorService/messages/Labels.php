<?php

namespace ContactForm\Libs\ValidatorService\Messages;

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
