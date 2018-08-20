<?php
    require_once __DIR__ . "/../../util/AtributoNaoEncontradoException.php";
    require_once __DIR__ . "/Entidade.php";
    require_once __DIR__ . "/Cargo.php";
    require_once __DIR__ . "/Empresa.php";
    
    class FuncionarioCargo extends Entidade
    {
        private $cargo;
        private $empresa;
        private $dataInicio;
        private $dataFim;
        private $descricao;

        public function __get($atributo)
        {
            switch ($atributo)
            {
                case "codigo": return $this -> codigo; break;
                case "cargo": return $this -> cargo; break;
                case "empresa": return $this -> empresa; break;
                case "dataInicio": return $this -> dataInicio; break;
                case "dataFim": return $this -> dataFim; break;
                case "descricao": return $this -> descricao; break;
                default: throw new AtributoNaoEncontradoException($atributo);
            }
        }

        public function __set($atributo, $valor)
        {
            switch ($atributo)
            {
                case "codigo": $this -> codigo = $valor; break;
                case "cargo": $this -> cargo = $valor; break;
                case "empresa": $this -> empresa = $valor; break;
                case "dataInicio": $this -> dataInicio = $valor; break;
                case "dataFim": $this -> dataFim = $valor; break;
                case "descricao": $this -> descricao = $valor; break;
                default: throw new AtributoNaoEncontradoException($atributo);
            }
        }

        public function __construct()
        {
            parent::__construct();
            $this -> cargo = null;
            $this -> empresa = null;
            $this -> dataInicio = null;
            $this -> dataFim = null;
            $this -> descricao = "";
        }

        public function jsonSerialize()
        {
            return
            [
                'codigo' => $this -> codigo,
                'cargo' => $this -> cargo,
                'empresa' => $this -> empresa,
                'dataInicio' => $this -> dataInicio,
                'dataFim' => $this -> dataFim,
                'descricao' => $this -> descricao
            ];
        }
    }
?>