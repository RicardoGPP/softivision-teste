<?php
    require_once __DIR__ . "/../../util/AtributoNaoEncontradoException.php";
    require_once __DIR__ . "/Entidade.php";
    
    class Cargo extends Entidade
    {
        private $nome;

        public function __get($atributo)
        {
            switch ($atributo)
            {
                case "codigo": return $this -> codigo; break;
                case "nome": return $this -> nome; break;
                default: throw new AtributoNaoEncontradoException($atributo);
            }
        }

        public function __set($atributo, $valor)
        {
            switch ($atributo)
            {
                case "codigo": $this -> codigo = $valor; break;
                case "nome": $this -> nome = $valor; break;
                default: throw new AtributoNaoEncontradoException($atributo);
            }
        }

        public function __construct()
        {
            parent::__construct();
            $this -> nome = "";
        }

        public function jsonSerialize()
        {
            return
            [
                'codigo' => $this -> codigo,
                'nome' => $this -> nome
            ];
        }
    }
?>