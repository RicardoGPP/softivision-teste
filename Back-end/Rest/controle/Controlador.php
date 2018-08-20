<?php
    require_once __DIR__ . "/Resposta.php";
    require_once __DIR__ . "/../modelo/entidade/FuncionarioCargo.php";
    require_once __DIR__ . "/../modelo/dao/FuncionarioCargoDAO.php";
    require_once __DIR__ . "/../modelo/dao/CargoDAO.php";
    require_once __DIR__ . "/../modelo/dao/EmpresaDAO.php";
    
    class Controlador
    {        
        private $funcionarioCargoDAO;
        private $cargoDAO;
        private $empresaDAO;
        
        public function __construct()
        {
            $this -> funcionarioCargoDAO = new FuncionarioCargoDAO();
            $this -> cargoDAO = new CargoDAO();
            $this -> empresaDAO = new EmpresaDAO();
        }
        
        public function obterCargos()
        {
            $resposta = null;
            try
            {
                $resposta = new Resposta(true, "", $this -> cargoDAO -> obterLista());
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), null);
            }
            return $resposta;
        }

        public function obterEmpresas()
        {
            $resposta = null;
            try
            {
                $resposta = new Resposta(true, "", $this -> empresaDAO -> obterLista());
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), null);
            }
            return $resposta;
        }

        public function obterFuncionarioCargo($codigo)
        {
            $resposta = null;
            try
            {
                $resposta = new Resposta(true, "", $this -> funcionarioCargoDAO -> obterRegistro($codigo));
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), "");
            }
            return $resposta;
        }
        
        public function obterFuncionarioCargos()
        {
            $resposta = null;
            try
            {
                $resposta = new Resposta(true, "", $this -> funcionarioCargoDAO -> obterLista());
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), null);
            }
            return $resposta;
        }

        public function incluirFuncionarioCargo($parametros)
        {
            $resposta = null;
            try
            {
                $funcionarioCargo = new FuncionarioCargo();
                $funcionarioCargo -> cargo = $this -> cargoDAO -> obterRegistro($parametros["cargo"]);
                $funcionarioCargo -> empresa = $this -> empresaDAO -> obterRegistro($parametros["empresa"]);
                $funcionarioCargo -> dataInicio = $parametros["data_inicio"];
                $funcionarioCargo -> dataFim = $parametros["data_fim"];
                $funcionarioCargo -> descricao = $parametros["descricao"];
                $funcionarioCargo = $this -> funcionarioCargoDAO -> incluir($funcionarioCargo);
                $resposta = new Resposta(true, "", $funcionarioCargo);
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), null);
            }
            return $resposta;
        }

        public function excluirFuncionarioCargo($codigo)
        {
            $resposta = null;
            try
            {
                $funcionarioCargo = $this -> funcionarioCargoDAO -> obterRegistro($codigo);
                if ($funcionarioCargo != null)
                    $this -> funcionarioCargoDAO -> excluir($funcionarioCargo);
                $resposta = new Resposta(true, "", null);
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), null);
            }
            return $resposta;
        }

        public function editarFuncionarioCargo($parametros)
        {
            $resposta = null;
            try
            {
                $funcionarioCargo = new FuncionarioCargo();
                $funcionarioCargo -> codigo = $parametros["codigo"];
                $funcionarioCargo -> cargo = $this -> cargoDAO -> obterRegistro($parametros["cargo"]);
                $funcionarioCargo -> empresa = $this -> empresaDAO -> obterRegistro($parametros["empresa"]);
                $funcionarioCargo -> dataInicio = $parametros["data_inicio"];
                $funcionarioCargo -> dataFim = $parametros["data_fim"];
                $funcionarioCargo -> descricao = $parametros["descricao"];
                $this -> funcionarioCargoDAO -> editar($funcionarioCargo);
                $resposta = new Resposta(true, "", null);
            } catch (Exception $e)
            {
                $resposta = new Resposta(false, $e -> getMessage(), null);
            }
            return $resposta;
        }
    }
?>