<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['admin'] != 1) { //Foi escolhido dar acesso ao histórico apenas a utilizadores com privilégio de "admin".
    http_response_code(401);    //Código 401 - Unauthorized
    header("refresh:1;url=dashboard.php"); //Força o reencaminhamento de volta para a dashboard (que poderá também reencaminhar para o index.php)
    die("Acesso restrito.");
}
if (!isset($_GET['dispositivo'])) {
    http_response_code(404);    //Código 404 - Not Found
    header("refresh:1;url=dashboard.php"); //Força o reencaminhamento de volta para a dashboard quando nao recebe o dispositivo correto (pelo método GET)
    die("Dispositivo não existente.");
}

//Vai buscar os valores necessários aos ficheiros:
$valor = file_get_contents("api/files/" . $_GET["dispositivo"] . "/valor.txt");
$hora = file_get_contents("api/files/" . $_GET["dispositivo"] . "/hora.txt");
$nome = file_get_contents("api/files/" . $_GET["dispositivo"] . "/nome.txt");
//echo($_GET["dispositivo"]); //Linha de teste
?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartHome - Histórico</title>
    <meta http-equiv="refresh" content="10">
    <!--para ir dando refresh à pagina de 5 em 5 segundos-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><!--CSS do Bootstrap-->
    <link rel="stylesheet" href="style.css">
    <!--para "linkar" com nosso ficheiro CSS-->
</head>

<body class="fundodois">
    <header>
        <!--Navbar:-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand dash" href="dashboard.php">SmartHome - Dashboard</a><!--Botão para o Dashboard-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <form class="d-flex" action="logout.php">
                        <button class="btn btn-info" type="submit">Sair</button><!--Botão de Logout-->
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container col-6" style="margin-top: 20px;">
        <div class="card">
            <div class="titulo">Histórico</div>
            <div class="card-header subtitulo"><b><?php echo $nome; ?></b>
                <img src=<?php echo ("images/" . $nome . ".png") ?> width="138" alt="Logotipo" class="float-end"><!--Logotipo à direita-->
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Data de Atualização</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $array = file_get_contents("api/files/" . $_GET["dispositivo"] . "/log.txt"); //Vai ler o conteúdo do ficheiro log da pasta do respetivo dispositivo (recebido pelo método GET)
                        $lines = explode("\n", $array); //Divide a string contida na variável "array" (por cada linha) e coloca-a no vetor "lines"

                        foreach ($lines as $line) { //for each faz um ciclo "for" que percorre o vetor "lines"
                            if ($line != "") {
                                //echo $line . '<br>'; //Linha de teste
                                $valor = explode(";", $line);   //separa a linha pelo ";" atribuindo a data ao "$valor[0]" e o valor ao "$valor[1]"
                        ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $valor[0] . '<br>'; //imprime a linha da data
                                        //var_dump($valor); //Linha de teste

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($nome == "Temperatura" || $nome == "Fumo" || $nome == "Humidade"){
                                        echo $valor[1] . '<br>'; //imprime a linha do valor
                                        //var_dump($valor); //Linha de teste
                                    }
                                    if($nome == "Estores"){
                                        if($valor[1] == 2){ echo ("Abertos");}
                                        elseif($valor[1] == 1){ echo ("Entreabertos");}
                                        else{echo ("Fechados");}
                                    }
                                    elseif($nome == "Luminosidade"){
                                        if($valor[1] == 1){ echo ("Alta");}
                                        else{echo ("Baixa");}
                                    }
                                    elseif($nome == "Movimento"){
                                        if($valor[1] == 1){ echo ("Com Movimento");}
                                        else{echo ("Sem Movimento");}
                                    }
                                    elseif($nome == "Porta"){
                                    if($valor[1] == 1){ echo ("Aberta");}
                                        else{echo ("Fechada");}
                                    }
                                    elseif($nome == "Camara")
                                    if($valor[1] == 1){ echo ("Fotografia Tirada");}
                                        else{echo ("Camara Desligada");}
                                    else{
                                    }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>