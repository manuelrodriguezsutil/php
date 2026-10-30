<?php
class Template
{
    function __construct($idioma = 'ES')
    {
        $this->$idioma = $idioma;
    }

    static function header($titulo, $descripcion = '')
    {
        return "" . self::navegacion();
    }

    static function navegacion()
    {
        return "";
    }

    static function footer()
    {
        return "";
    }
}
