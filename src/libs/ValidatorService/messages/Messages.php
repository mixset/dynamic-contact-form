<?php

namespace ContactForm\Libs\ValidatorService\Messages;

class Messages
{
    public function getValidatorMessages()
    {
        return [
            'required' => 'Pole %s jest wymagane.',
            'date' => 'Pole %s nie jest poprawną datą.',
            'email' => 'Pole %s nie jest poprawnym adresem E-mail.',
            'length' => 'Pole %d musi zawierać dokładnie %d znaków.',
            'max_length' => 'Pole %s może zawierać maksymalnie %d znaków.',
            'min_length' => 'Pole %s musi zawierać co najmniej %d znaków.',
        ];
    }
}
