<?php
    class AtributoNaoEncontradoException extends Exception
    {
        public function __construct($atributo)
        {
            parent::__construct("O atributo \"$atributo\" não foi encontrado.");
        }
    }
?>

