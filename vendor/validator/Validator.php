<?php

namespace vendor;

class Validator
{
    private array $data;
    private array $errors;

    public function __construct(array $data) {

        $this->data = $data;

        $this->errors = [];

    }

    public function validate($rules) {

        foreach ($rules as $field => $rule) {

            $value = $this->getValue($field);

            foreach ($rule as $ruleParams) {

                $method = 'validate' . ucfirst($ruleParams);

                if (method_exists($this, $method)) {

                    $this->$method($field, $value, $ruleParams);

                }

            }
        }

        return $this->errors;
    }

    private function getValue($field) {

        if (isset($this->data[$field])) {

            return $this->data[$field];

        }

        return null;

    }

    private function addError($field, $message) {
        $this->errors[$field][] = $message;
    }

    private function validateRequired($field, $value, $params) {

        if (empty($value)) {

            $this->addError($field, 'Поле ' . $field . ' обязательно для заполнения');

        }

    }

    private function validateEmail($field, $value, $params) {

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {

            $this->addError($field, 'Поле ' . $field . ' должно быть корректным адресом электронной почты');

        }

    }

    private function validateString($field, $value, $params) {

        if (gettype($value) !== 'string') {

            $this->addError($field, 'Поле ' . $field . ' должно быть строкой');

        }

    }

    private function validateInt($field, $value, $params) {

        if(is_numeric((int) $value)) {

            $this->addError($field, 'Поле ' . $field . ' должно быть целым числом');

        }

    }

    private function validateLogin($field, $value, $params) {

        $email = $this->getValue('email');

        $password = $this->getValue('password');

        require_once '../../app/Models/User.php';

        if(!empty($email) && !empty($password)) {

            $user = \User::query()->where('email', '=', $email)->where('password', '=', $password)->first();

            if($user['email'] !== $email || $user['password'] !== $password) {

                $this->addError($field, 'Неверный логин или пароль');

            }

        }

    }

}