<?php
class Validator
{
    //valida input
    public static function validateInput($type, $variable_name) {
        $input = filter_input($type, $variable_name);
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    //valida usuarios
    public static function validateCandidato($candidato)
    {
        $errors = [];

        if (empty($candidato->getNombre())) {
            $errors[] = "El campo 'nombre' es obligatorio.";
        }

        if (empty($candidato->getDni())) {
            $errors[] = "El campo 'apellidos' es obligatorio.";
        }

        if (empty($candidato->getCorreo())) {
            $errors[] = "El campo 'email' es obligatorio.";
        } elseif (!filter_var($candidato->getCorreo(), FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El campo 'email' no es válido.";
        }

        if (empty($candidato->getPassword())) {
            $errors[] = "El campo 'password' es obligatorio.";
        }

        return $errors;
    }

}
?>