<?php
class Validator
{
    //valida input
    public static function validateInput($type, $variable_name) {
        $input = filter_input($type, $variable_name);
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    //valida usuarios
    public static function validateUsuario($usuario)
    {
        $errors = [];

        if (empty($usuario->getNombre())) {
            $errors[] = "El campo 'nombre' es obligatorio.";
        }

        if (empty($usuario->getApellidos())) {
            $errors[] = "El campo 'apellidos' es obligatorio.";
        }

        if (empty($usuario->getEmail())) {
            $errors[] = "El campo 'email' es obligatorio.";
        } elseif (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El campo 'email' no es válido.";
        }

        if (empty($usuario->getPassword())) {
            $errors[] = "El campo 'password' es obligatorio.";
        }

        return $errors;
    }

    //valida becas
    public static function validateBeca($beca)
    {
        $errors = [];

        if (empty($beca->nombre)) {
            $errors[] = "El campo 'nombre' es obligatorio.";
        }

        if (empty($beca->cantidad)) {
            $errors[] = "El campo 'cantidad' es obligatorio.";
        } elseif (!is_numeric($beca->cantidad) || $beca->cantidad <= 0) {
            $errors[] = "El campo 'cantidad' debe ser un número mayor que cero.";
        }

        if (empty($beca->fechaFin)) {
            $errors[] = "El campo 'fechaFin' es obligatorio.";
        } elseif (!strtotime($beca->fechaFin)) {
            $errors[] = "El campo 'fechaFin' no es válido.";
        }

        return $errors;
    }
}
?>