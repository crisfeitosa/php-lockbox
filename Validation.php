<?php

class Validation {
    public $validations = [];

    public static function validate($rules, $data) {
        $validation = new self;

        foreach($rules as $field => $fieldRules) {
            foreach($fieldRules as $rule) {
                $valueField = $data[$field];

                if($rule == 'confirmed') {
                    $validation->$rule($field, $valueField, $data["{$field}_confirmation"]);
                } else if (str_contains($rule, ':')) {
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

    private function required($field, $value) {
        if(strlen($value) == 0) {
            $this->validations[] = "O $field é obrigatório.";
        }
    }

    private function email($field, $value) {
        if(! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->validations[] = "O $field é inválido.";
        }
    }

    private function confirmed($field, $value, $valueConfirmed) {
        if ($value != $valueConfirmed) {
            $this->validations[] = "O $field de confirmação está diferente.";
        }
    }

    private function unique($table, $field, $value) {
        if (strlen($value) == 0) {
            return;
        }

        $db = new Database(config('database'));

        $result = $db->query(
            query: "select * from $table where $field = :value",
            params: ['value' => $value]
        )->fetch();

        if ($result) {
            $this->validations[] = "O $value já está sendo usado.";
        }
    }

    private function min($min, $field, $value) {
        if (strlen($value) <= $min) {
            $this->validations[] = "O $field precisa ter um mínimo de $min caracteres.";
        }
    }

    private function max($max, $field, $value) {
        if (strlen($value) > $max) {
            $this->validations[] = "O $field precisa ter um máximo de $max caracteres.";
        }
    }

    private function strong($field, $value) {
        if (! strpbrk($value, "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~")) {
            $this->validations[] = "A $field precisa ter ao menos um caractere especial nela.";
        }
    }

    public function notValid($nameCustom = null) {
        $key = 'validations';

        if($nameCustom) {
            $key .= '_' . $nameCustom;
        }

        flash()->push($key, $this->validations);

        return sizeof($this->validations) > 0;
    }
}
