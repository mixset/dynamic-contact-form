<?php

namespace ContactForm\Libs\ValidatorService;

use ContactForm\Core\Helpers;
use ContactForm\Libs\ValidatorService\Messages\Labels;
use ContactForm\Libs\ValidatorService\Messages\Messages;

class ValidatorService
{
    private $messages = [];
    private $labels = [];

    public $errors = [];

    public function __construct()
    {
        $this->messages = (new Messages())->getValidatorMessages();
        $this->labels = (new Labels())->getInputLabels();
    }

    public function validate($fields, array $conditions)
    {
        $array_fields_to_validate = array_keys($conditions);
        $fields = filter_var_array($fields, FILTER_SANITIZE_STRING);
        $fields = array_map('trim', $fields);

        foreach ($fields as $key => $value) {
            if (in_array($key, $array_fields_to_validate)) {
                $this->errors[] = $this->validateByConditions($conditions[$key], $key, $value);
            }
        }

        $this->errors = Helpers::arrayFlatten($this->errors);

        return $fields;
    }

    protected function createConditionsFromString($condition_string)
    {
        return explode('|', $condition_string);
    }

    protected function validateByConditions($condition_string, $field_key, $field_value)
    {
        $errors = [];
        $conditions = $this->createConditionsFromString($condition_string);

        foreach ($conditions as $key => $value) {
            $validator = $this->getValidator($value);
            $className = $this->getClass($validator['class']);

            if ($this->isSometimesOperator($validator['class']) === true) {
                continue;
            }

            if ($className->validate($field_value, $validator['argument']) === false) {
                $errors[] = sprintf(
                    $this->messages[$validator['message_key']],
                    $this->labels[$field_key],
                    $validator['argument']
                );
            }
        }

        return $errors;
    }

    private function isSometimesOperator($class)
    {
        return strtolower($class) === 'sometimes';
    }

    private function getClass($validator)
    {
        $rule_parts = explode(':', $validator);
        $className = 'ContactForm\\Libs\\ValidatorService\\Validators\\' . ucfirst($rule_parts[0]);

        if (class_exists($className)) {
            return new $className;
        }
    }

    private function getValidator($value)
    {
        $validator = explode(':', $value);

        return array(
            'class' => ucfirst(Helpers::toCamelCase($validator[0])),
            'message_key' => $validator[0],
            'argument' => isset($validator[1]) ? $validator[1] : '',
        );
    }

    public function countErrors()
    {
        return count($this->errors);
    }
}
