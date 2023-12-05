<?php
class Validator
{
    //valida input
    public static function validateInput($type, $variable_name) {
        $input = filter_input($type, $variable_name);
        if (empty($input)) {
            //muestra error si esta vacio
            throw new Exception("El campo '$variable_name' es obligatorio.");

        }
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    public static function validatePostArray($postArray) {
        foreach ($postArray as $key => $value) {
            if (!Validator::validateInput(INPUT_POST, $key)) {
                throw new Exception("Fallo en la validación de del array $postArray.");
            }
        }
    }

    //funcion valida dni
    public static function validarDNI($dni) {
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    
        // Extraer los números y la letra
        $numeros = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letra= strtoupper($letra);
    
        // Calcular la letra correcta
        $letraCorrecta = $letras[$numeros % 23];
    
        // Comparar la letra proporcionada con la letra correcta
        return $letra == $letraCorrecta;
    }


    //valida usuarios
    public static function validateCandidato($candidato)
    {
        $errors = [];

        if (empty($candidato->getNombre())) {
            $errors[] = "El campo 'nombre' es obligatorio.";
        }
 
        if (empty($candidato->getDni())) {
            $errors[] = "El campo 'dni' es obligatorio.";
        } elseif (!self::validarDNI($candidato->getDni())) {
            $errors[] = "El campo 'dni' no es válido.";
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