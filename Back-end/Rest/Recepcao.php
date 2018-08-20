<?php    
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
	
	require_once __DIR__ . "/controle/Resposta.php";
    require_once __DIR__ . "/controle/Controlador.php";    

    $controlador = new Controlador();
    $metodo = $_GET["metodo"];
    $resposta = null;

    switch ($metodo)
    {
        case "obterCargos": $resposta = $controlador -> $metodo(); break;
        case "obterEmpresas": $resposta = $controlador -> $metodo(); break;
        case "obterFuncionarioCargo": $resposta = $controlador -> $metodo($_GET["codigo"]); break;
        case "obterFuncionarioCargos": $resposta = $controlador -> $metodo(); break;
        case "incluirFuncionarioCargo": $resposta = $controlador -> $metodo($_POST); break;
        case "excluirFuncionarioCargo": $resposta = $controlador -> $metodo($_GET["codigo"]); break;
        case "editarFuncionarioCargo": $resposta = $controlador -> $metodo($_POST);
    }

    if ($resposta != null)
        echo json_encode($resposta);
    else
        echo json_encode(new Resposta(false, "Ocorreu um erro no processamento da requisição.", null));
?>