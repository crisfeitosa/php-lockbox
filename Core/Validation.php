<?php

declare(strict_types = 1);

namespace Core;

class Validation
{
    public $validations = [];

    public static function validate($rules, $data)
    {
        $validation = new self();

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $valueField = $data[$field];

                if ($rule == 'confirmed') {
                    $validation->$rule($field, $valueField, $data["{$field}_confirmation"]);
                } elseif (str_contains($rule, ':')) {
                    $temp = explode(':', $rule);

                    $rule = $temp[0];

                    $ruleAr = $temp[1];

                    $validation->$rule($ruleAr, $field, $valueField);
                } else {
                    $validation->$rule($field, $valueField);
                }
            }
        }

        return $validation;
    }

    private function required($field, $value)
    {
        if (strlen($value) == 0) {
            $this->addError($field, "O $field é obrigatório.");
        }
    }

    private function email($field, $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "O $field é inválido.");
        }
    }

    private function confirmed($field, $value, $valueConfirmed)
    {
        if ($value != $valueConfirmed) {
            $this->addError($field, "O $field de confirmação está diferente.");
        }
    }

    private function unique($table, $field, $value)
    {
        if (strlen($value) == 0) {
            return;
        }

        $db = new Database(config('database'));

        $result = $db->query(
            query: "select * from $table where $field = :value",
            params: ['value' => $value]
        )->fetch();

        if ($result) {
            $this->addError($field, "O $field já está sendo usado.");
        }
    }

    private function min($min, $field, $value)
    {
        if (strlen($value) < $min) {
            $this->addError($field, "O $field precisa ter um mínimo de $min caracteres.");
        }
    }

    private function max($max, $field, $value)
    {
        if (strlen($value) > $max) {
            $this->addError($field, "O $field precisa ter um máximo de $max caracteres.");
        }
    }

    private function strong($field, $value)
    {
        if (! strpbrk($value, "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~")) {
            $this->addError($field, "A $field precisa um caractere especial nela.");
        }
    }

    private function addError($field, $erro)
    {
        $this->validations[$field][] = $erro;
    }

    public function notValid($nameCustom = null)
    {
        $key = 'validations';

        if ($nameCustom) {
            $key .= '_' . $nameCustom;
        }

        flash()->push($key, $this->validations);

        return count($this->validations) > 0;
    }
}
