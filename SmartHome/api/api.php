<?php

/*session_start();
//Foi escolhido criar esta validação de sessão para o API também, por questões de segurança. O servidor poderia (eventualmente) ter permissões iguais ao utilizador "servidor" declarado em index.php
if (!isset($_SESSION['username'])) {
    http_response_code(401); //Código 401 - Unauthorized
    die("Acesso restrito.");
}*/

header('Content-Type: text/html; charset=utf-8'); //Linha útil para enviar informação ao api (com a extensão de browser "RESTer")

//Inserção dos valores nos ficheiros, por parte do API:
    //Inserção dos valores, pelo método POST:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["nome"], $_POST["valor"], $_POST["hora"])) {

        echo file_put_contents("files/" . $_POST['nome'] . "/valor.txt", $_POST["valor"]);
        echo file_put_contents("files/" . $_POST['nome'] . "/hora.txt", $_POST["hora"]);
        echo file_put_contents("files/" . $_POST['nome'] . "/log.txt", $_POST["hora"] . ";" . $_POST['valor'] . PHP_EOL, FILE_APPEND | LOCK_EX);//inserção da hora e do valor (separados com um ";"). 
            //PHP_EOL muda de linha, FILE_APPEND adiciona a nova linha ao ficheiro sem o reescrever por inteiro, e | LOCK_EX bloqueia o ficheiro enquanto está a escrever nele
    } else {
        echo ("POST inviavel");
        //echo ((file_get_contents("php://input")));    //linha de código de teste
        http_response_code(400); //Código 400 - Bad Request
    }
    //Inserção dos valores, pelo método GET (poderá ser útil na Fase 2 do projeto):
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["nome"])) {
        echo file_get_contents("files/" . $_GET["nome"] . "/valor.txt");
    } else {
        echo ("Faltam parametros no GET");
        http_response_code(400); //Código 400 - Bad Request
    }
} else {
    echo ("Metodo nao permitido");
    http_response_code(405); //Código 405 - Method Not Allowed
}

?>