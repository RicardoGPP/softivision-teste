<?php
    require_once __DIR__ . "/../conexao/Conexao.php";
    require_once __DIR__ . "/../entidade/FuncionarioCargo.php";
    require_once __DIR__ . "/CargoDAO.php";
    require_once __DIR__ . "/EmpresaDAO.php";
    require_once __DIR__ . "/../../util/ComandoSQL.php";

    class FuncionarioCargoDAO
    {
        private $cargoDAO;
        private $empresaDAO;

        public function __construct()
        {
            $this -> cargoDAO = new CargoDAO();
            $this -> empresaDAO = new EmpresaDAO();
        }
        
        public function obterRegistro($codigo)
        {
            $funcionarioCargo = null;
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("SELECT");
            $sql -> adicionar("*");
            $sql -> adicionar("FROM");
            $sql -> adicionar("FUNCIONARIO_CARGO");
            $sql -> adicionar("WHERE");
            $sql -> adicionar("CODIGO = :CODIGO");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> bindValue(":CODIGO", $codigo, PDO::PARAM_INT);
            $comando -> execute();
            $conexao -> commit();
            if ($comando -> rowCount() == 1)
            {   
                $resultado = $comando -> fetchAll()[0];                       
                $funcionarioCargo = new FuncionarioCargo();                
                $funcionarioCargo -> codigo = $resultado["CODIGO"];
                $funcionarioCargo -> cargo = $this -> cargoDAO -> obterRegistro($resultado["CARGO"]);
                $funcionarioCargo -> empresa = $this -> empresaDAO -> obterRegistro($resultado["EMPRESA"]);
                $funcionarioCargo -> dataInicio = $resultado["DATA_INICIO"];
                $funcionarioCargo -> dataFim = $resultado["DATA_FIM"];
                $funcionarioCargo -> descricao = ($resultado["DESCRICAO"] == null) ? "" : $resultado["DESCRICAO"];
            }
            return $funcionarioCargo;
        }

        public function obterLista()
        {
            $funcionarioCargos = array();
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("SELECT");
            $sql -> adicionar("*");
            $sql -> adicionar("FROM");
            $sql -> adicionar("FUNCIONARIO_CARGO");
            $sql -> adicionar("ORDER BY");
            $sql -> adicionar("DATA_INICIO DESC");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> execute();
            $conexao -> commit();
            if ($comando -> rowCount() > 0)
            {
                $resultados = $comando -> fetchAll();
                foreach($resultados as $resultado)
                {
                    $funcionarioCargo = new FuncionarioCargo();                
                    $funcionarioCargo -> codigo = $resultado["CODIGO"];
                    $funcionarioCargo -> cargo = $this -> cargoDAO -> obterRegistro($resultado["CARGO"]);
                    $funcionarioCargo -> empresa = $this -> empresaDAO -> obterRegistro($resultado["EMPRESA"]);
                    $funcionarioCargo -> dataInicio = $resultado["DATA_INICIO"];
                    $funcionarioCargo -> dataFim = $resultado["DATA_FIM"];
                    $funcionarioCargo -> descricao = ($resultado["DESCRICAO"] == null) ? "" : $resultado["DESCRICAO"];
                    array_push($funcionarioCargos, $funcionarioCargo);
                }            
            }
            return $funcionarioCargos;
        }

        public function incluir($funcionarioCargo)
        {
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();            
            $sql -> adicionar("SELECT INCLUIR_FUNCIONARIO_CARGO(:CARGO, :EMPRESA, :DATA_INICIO, :DATA_FIM, :DESCRICAO) AS CODIGO");                        
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> bindValue(":CARGO", $funcionarioCargo -> cargo -> codigo, PDO::PARAM_INT);
            $comando -> bindValue(":EMPRESA", $funcionarioCargo -> empresa -> codigo, PDO::PARAM_INT);
            $comando -> bindValue(":DATA_INICIO", $funcionarioCargo -> dataInicio, PDO::PARAM_STR);
            $comando -> bindValue(":DATA_FIM", $funcionarioCargo -> dataFim, PDO::PARAM_STR);
            $comando -> bindValue(":DESCRICAO", $funcionarioCargo -> descricao, PDO::PARAM_STR);
            $comando -> execute();
            $conexao -> commit();
            $funcionarioCargo -> codigo = $comando -> fetchAll()[0]["CODIGO"];
            return $funcionarioCargo;
        }

        public function excluir($funcionarioCargo)
        {
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("DELETE FROM");
            $sql -> adicionar("FUNCIONARIO_CARGO");
            $sql -> adicionar("WHERE");
            $sql -> adicionar("CODIGO = :CODIGO");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> bindValue(":CODIGO", $funcionarioCargo -> codigo, PDO::PARAM_INT);
            $comando -> execute();
            $conexao -> commit();
        }

        public function editar($funcionarioCargo)
        {
            $conexao = Conexao::recuperar();
            $conexao -> beginTransaction();
            $sql = new ComandoSQL();
            $sql -> adicionar("UPDATE");
            $sql -> adicionar("FUNCIONARIO_CARGO");            
            $sql -> adicionar("SET");
            $sql -> adicionar("CARGO = :CARGO,");
            $sql -> adicionar("EMPRESA = :EMPRESA,");
            $sql -> adicionar("DATA_INICIO = :DATA_INICIO,");
            $sql -> adicionar("DATA_FIM = :DATA_FIM,");
            $sql -> adicionar("DESCRICAO = :DESCRICAO");
            $sql -> adicionar("WHERE");
            $sql -> adicionar("CODIGO = :CODIGO");
            $comando = $conexao -> prepare($sql -> comando);
            $comando -> bindValue(":CARGO", $funcionarioCargo -> cargo -> codigo, PDO::PARAM_INT);
            $comando -> bindValue(":EMPRESA", $funcionarioCargo -> empresa -> codigo, PDO::PARAM_INT);
            $comando -> bindValue(":DATA_INICIO", $funcionarioCargo -> dataInicio, PDO::PARAM_STR);
            $comando -> bindValue(":DATA_FIM", $funcionarioCargo -> dataFim, PDO::PARAM_STR);
            $comando -> bindValue(":DESCRICAO", $funcionarioCargo -> descricao, PDO::PARAM_STR);
            $comando -> bindValue(":CODIGO", $funcionarioCargo -> codigo, PDO::PARAM_INT);
            $comando -> execute();
            $conexao -> commit();
        }
    }
?>