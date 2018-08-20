<?php
    require_once __DIR__ . "/AtributoNaoEncontradoException.php";
    
    class ComandoSQL
    {
        private $comando;

        public function __get($atributo)
        {
            if ($atributo == "comando")
                return $this -> comando;
            else
                throw new AtributoNaoEncontradoException($atributo);
        }

        public function __construct()
        {
            $this -> comando = "";
        }

        public function adicionar($linha)
        {
            if ($this -> comando != "")
                $this -> comando .= " ";
            $this -> comando .= trim($linha);
        }
    }
?>