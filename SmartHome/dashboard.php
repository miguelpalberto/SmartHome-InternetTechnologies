<?php
session_start();

if (!isset($_SESSION['username'])) {
    http_response_code(401); //Código 401 - Unauthorized
    header("refresh:2;url=index.php"); //Força o reencaminhamento (em 2 segundos) de volta para o index (caso o utilizador tente aceder ao dashboard sem ter iniciado a sessao correta)
    die("Acesso restrito.");
}

//Obter informação dos Sensores:
$valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
$hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
$nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");

$valor_luminosidade = file_get_contents("api/files/luminosidade/valor.txt");
$hora_luminosidade = file_get_contents("api/files/luminosidade/hora.txt");
$nome_luminosidade = file_get_contents("api/files/luminosidade/nome.txt");

$valor_humidade = file_get_contents("api/files/humidade/valor.txt");
$hora_humidade = file_get_contents("api/files/humidade/hora.txt");
$nome_humidade = file_get_contents("api/files/humidade/nome.txt");

$valor_fumo = file_get_contents("api/files/fumo/valor.txt");
$hora_fumo = file_get_contents("api/files/fumo/hora.txt");
$nome_fumo = file_get_contents("api/files/fumo/nome.txt");

$valor_porta = file_get_contents("api/files/porta/valor.txt");
$hora_porta = file_get_contents("api/files/porta/hora.txt");
$nome_porta = file_get_contents("api/files/porta/nome.txt");

$valor_estores = file_get_contents("api/files/estores/valor.txt");
$hora_estores = file_get_contents("api/files/estores/hora.txt");
$nome_estores = file_get_contents("api/files/estores/nome.txt");

$valor_movimento = file_get_contents("api/files/movimento/valor.txt");
$hora_movimento = file_get_contents("api/files/movimento/hora.txt");
$nome_movimento = file_get_contents("api/files/movimento/nome.txt");

$valor_camara = file_get_contents("api/files/camara/valor.txt");
$hora_camara = file_get_contents("api/files/camara/hora.txt");
$nome_camara = file_get_contents("api/files/camara/nome.txt");

$valor_nivelagua = file_get_contents("api/files/nivelagua/valor.txt");
$hora_nivelagua = file_get_contents("api/files/nivelagua/hora.txt");
$nome_nivelagua = file_get_contents("api/files/nivelagua/nome.txt");

//Obter informação dos Atuadores:
$valor_alarme = file_get_contents("api/files/atuadores/alarme/valor.txt");
$hora_alarme = file_get_contents("api/files/atuadores/alarme/hora.txt");
$nome_alarme = file_get_contents("api/files/atuadores/alarme/nome.txt");

$valor_arcondicionado = file_get_contents("api/files/atuadores/arcondicionado/valor.txt");
$hora_arcondicionado = file_get_contents("api/files/atuadores/arcondicionado/hora.txt");
$nome_arcondicionado = file_get_contents("api/files/atuadores/arcondicionado/nome.txt");

$valor_chuveiros = file_get_contents("api/files/atuadores/chuveiros/valor.txt");
$hora_chuveiros = file_get_contents("api/files/atuadores/chuveiros/hora.txt");
$nome_chuveiros = file_get_contents("api/files/atuadores/chuveiros/nome.txt");

$valor_dreno = file_get_contents("api/files/atuadores/dreno/valor.txt");
$hora_dreno = file_get_contents("api/files/atuadores/dreno/hora.txt");
$nome_dreno = file_get_contents("api/files/atuadores/dreno/nome.txt");

$valor_ventilacao = file_get_contents("api/files/atuadores/ventilacao/valor.txt");
$hora_ventilacao = file_get_contents("api/files/atuadores/ventilacao/hora.txt");
$nome_ventilacao = file_get_contents("api/files/atuadores/ventilacao/nome.txt");

$valor_fechadura = file_get_contents("api/files/atuadores/fechadura/valor.txt");
$hora_fechadura = file_get_contents("api/files/atuadores/fechadura/hora.txt");
$nome_fechadura = file_get_contents("api/files/atuadores/fechadura/nome.txt");

$valor_motorestores = file_get_contents("api/files/atuadores/motorestores/valor.txt");
$hora_motorestores = file_get_contents("api/files/atuadores/motorestores/hora.txt");
$nome_motorestores = file_get_contents("api/files/atuadores/motorestores/nome.txt");

?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <!--para ir dando refresh à pagina de 5 em 5 segundos-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Biblioteca Ajax para Botao-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--CSS do Bootstrap-->
    <link rel="stylesheet" href="style.css">
    <!--para "linkar" com nosso ficheiro CSS-->
    <title>SmartHome - Dashboard</title>
    <script>
        /*
    function dataHora() {
        var dateISO = new Date().toISOString(); //resultado 2020-03-05T16:42:51.923Z        
        // --- é necessário separar ( função split() ) este valor pela letra T que separa a data da hora.
        var data0 = dateISO.split('T')[0]; //dividir data pela letra T, e guardar 1ºelemento do array
        //data 0 = 2020-03-05
        var data1 = dateISO.split('T')[1]; //dividir data pela letra T, e guardar 2ºelemento do array
        //data 1 = 16:42:51.923Z
        // é ainda necessário retirar os milissegundos
        var time = data1.split('.')[0]; //dividir hora pelo . e guardar o 1º elemento do array
        // time = 16:42:51 --- falta juntar tudo
        var datahora = data0 + " " + time; // resultado 2020-03-05 16:56:15
        return datahora;
        }*/

        function dataHora() {
            var date = new Date();
            var dateInUTC = date.toISOString();//resultado 2020-03-05T16:42:51.923Z  // --- é necessário separar ( função split() ) este valor pela letra T que separa a data da hora. 
            var dateArr = dateInUTC.split("T");//dividir data pela letra T
            var time = date.toLocaleTimeString('en-PT', {hour12: false});
            return dateArr[0] + ' ' + time; //juntar // resultado 2020-03-05 16:56:15
        }

        function send_to_api(valores) {
            $.ajax({
                type: "POST",
                contentType: "application/x-www-form-urlencoded",
                url: "http://127.0.0.1:8080/SmartHome/api/api.php",
                data: valores,
                success: function(msg) {
                    //console.log("Data Saved: " + msg);
                }
            });
        }

        //Funcoes Ligar/Desligar Atuadores (botoes do dashboard)
        function ligarWebcam() {
            var valores = {
                'nome': 'camara',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function ligarAlarme() {//Alarme
            var valores = {
                'nome': 'atuadores/alarme',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function desligarAlarme() {
            var valores = {
                'nome': 'atuadores/alarme',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function ligarChuveiros() {//Chuveiros
            var valores = {
                'nome': 'atuadores/chuveiros',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function desligarChuveiros() {
            var valores = {
                'nome': 'atuadores/chuveiros',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function abrirEstoresTudo() {//Estores
            var valores = {
                'nome': 'atuadores/motorestores',
                'valor': 2,
                'hora': dataHora()
            }
            send_to_api(valores);
            var valores2 = {
                'nome': 'estores',
                'valor': 2,
                'hora': dataHora()
            }
            send_to_api(valores2);
        }
        function abrirEstoresMeio() {
            var valores = {
                'nome': 'atuadores/motorestores',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
            var valores2 = {
                'nome': 'estores',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores2);
        }
        function fecharEstores() {
            var valores = {
                'nome': 'atuadores/motorestores',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
            var valores2 = {
                'nome': 'estores',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores2);
        }
        function abrirPorta() {//Porta
            var valores = {
                'nome': 'atuadores/fechadura',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
            var valores2 = {
                'nome': 'porta',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores2);
        }
        function fecharPorta() {
            var valores = {
                'nome': 'atuadores/fechadura',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
            var valores2 = {
                'nome': 'porta',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores2);
        }
        function ligarDreno() {//Dreno
            var valores = {
                'nome': 'atuadores/dreno',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function desligarDreno() {
            var valores = {
                'nome': 'atuadores/dreno',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function ligarArCondicionadoAuto() {//Ar Condicionado
            var valores = {
                'nome': 'atuadores/arcondicionado',
                'valor': 3,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function ligarArCondicionadoQuente() {
            var valores = {
                'nome': 'atuadores/arcondicionado',
                'valor': 2,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function ligarArCondicionadoFrio() {
            var valores = {
                'nome': 'atuadores/arcondicionado',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function desligarArCondicionado() {
            var valores = {
                'nome': 'atuadores/arcondicionado',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function ligarVentilacao() {//Ventilacao
            var valores = {
                'nome': 'atuadores/ventilacao',
                'valor': 1,
                'hora': dataHora()
            }
            send_to_api(valores);
        }
        function desligarVentilacao() {
            var valores = {
                'nome': 'atuadores/ventilacao',
                'valor': 0,
                'hora': dataHora()
            }
            send_to_api(valores);
        }


        //Call AJAX (para botões):
        $("document").ready(function() {
            $("#ligarWebcam").click(ligarWebcam);
            $("#ligarAlarme").click(ligarAlarme);
            $("#desligarAlarme").click(desligarAlarme);
            $("#ligarChuveiros").click(ligarChuveiros);
            $("#desligarChuveiros").click(desligarChuveiros);
            $("#abrirEstoresTudo").click(abrirEstoresTudo);
            $("#abrirEstoresMeio").click(abrirEstoresMeio);
            $("#fecharEstores").click(fecharEstores);
            $("#abrirPorta").click(abrirPorta);
            $("#fecharPorta").click(fecharPorta);
            $("#ligarArCondicionadoAuto").click(ligarArCondicionadoAuto);
            $("#ligarArCondicionadoQuente").click(ligarArCondicionadoQuente);
            $("#ligarArCondicionadoFrio").click(ligarArCondicionadoFrio);
            $("#desligarArCondicionado").click(desligarArCondicionado);
            $("#ligarVentilacao").click(ligarVentilacao);
            $("#desligarVentilacao").click(desligarVentilacao);
            $("#ligarDreno").click(ligarDreno);
            $("#desligarDreno").click(desligarDreno);
            
        })
    </script>



</head>

<body class="fundodois">

    <header>
        <!--Navbar:-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand dash" href="dashboard.php">SmartHome - Dashboard</a>
                <!--Botão para o Dashboard-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>
                    <form class="d-flex" action="logout.php">
                        <button class="btn btn-info" type="submit">Sair</button>
                        <!--Botão de Logout-->
                    </form>
                </div>
            </div>
        </nav>


    </header>

    <!--Intro:-->
    <div class="container" style="margin-bottom: 20px; margin-top: 10px;">
        <div class="card">
            <div class="card-body">
                <img src="images/icon_casa.png" width="100" alt="Logotipo da SmartHome" class="float-end">
                <h1>Servidor IoT</h1>
                <p class="card-text" style="color: rgb(145,182,202)">Tecnologias de Internet - Engenharia Informática</p>
                <p class="card-title">Bem-vindo <b><?php echo $_SESSION['username'] ?></b></p>

                <!--Alertas:-->
                <p class="card-text alertas-graves-texto">
                    <?php
                    if ($valor_alarme == "1") {
                        echo ("ATENÇÃO: O alarme foi ligado!!!<br>"); //Avisa utilizador do alarme ligado
                    }
                    if ($valor_chuveiros == "1") {
                        echo ("ATENÇÃO: Os chuveiros anti-fogo foram abertos!!<br>"); //Avisa utilizador dos chuveiros abertos
                    }
                    ?></p>
                <p class="alertas-medianos-texto">
                    <?php
                    if ($valor_porta == "1") {
                        echo ("Porta Aberta: Não se esqueça de a fechar! <br>"); //Avisa utilizador da porta aberta
                    }
                    ?></p>
                <p class="card-text alertas-positivos-texto">
                    <?php if ($valor_alarme != "1" && $valor_chuveiros != "1" && $valor_porta != "1") {
                        echo ("Estado Segurança: Tudo OK"); //Dá o estado "OK"
                    }
                    ?></p>
            </div>
        </div>
    </div>



    <!--Main Cards:-->
    <div class="container">
        <div class="row" style="text-align: center;">

            <div class="card col-3">
                <div class="card-header">
                    <!--Titulo Sensor e Valor apresentado-->
                    <b><?php echo ($nome_luminosidade . ": ");
                        if ($valor_luminosidade == 1) {
                            echo ("Alta");
                        } else {
                            echo ("Baixa");
                        } ?></b>
                </div>
                <div class="card-body">
                    <!--Imagem Logotipo-->
                    <img <?php if ($valor_luminosidade == 0) { ?>src="images/Luminosidade.png" <?php } else { ?>src="images/Luminosidade_alta.png" <?php } ?> class="card-img" alt="Logotipo luminosidade">
                </div>
                <div class="card-footer">
                    <!--Ultima atualização do sensor e link para respetivo Histórico apenas para "admins"-->
                    <b>Última Atualização: </b>
                    <?php echo ($hora_luminosidade);
                    if ($_SESSION['admin'] == 1) { ?>
                        <a href="historico.php?dispositivo=luminosidade">Histórico</a>
                    <?php } ?>
                </div>
            </div>

            <div class="card col-3">
                <div class="card-header">
                    <b><?php echo ($nome_temperatura . ": " . $valor_temperatura . " ºC"); ?></b>
                </div>
                <div class="card-body">
                    <img <?php if ($valor_temperatura <= 20) { ?>src="images/Temperatura.png" <?php } else { ?>src="images/Temperatura_alta.png" <?php } ?> class="card-img" alt="Logotipo temperatura">
                </div>
                <div class="card-footer">
                    <b>Última Atualização: </b>
                    <?php echo ($hora_temperatura);
                    if ($_SESSION['admin'] == 1) { ?>
                        <a href="historico.php?dispositivo=temperatura">Histórico</a>
                    <?php } ?>
                </div>
            </div>

            <div class="card col-3">
                <div class="card-header">
                    <b><?php echo ($nome_humidade . ": " . $valor_humidade . "%"); ?></b>
                </div>
                <div class="card-body">
                    <img <?php if ($valor_humidade <= 50) { ?>src="images/Humidade.png" <?php } else { ?>src="images/Humidade_alta.png" <?php } ?> class="card-img" alt="Logotipo humidade">
                </div>
                <div class="card-footer">
                    <b>Última Atualização: </b>
                    <?php echo ($hora_humidade);
                    if ($_SESSION['admin'] == 1) { ?>
                        <a href="historico.php?dispositivo=humidade">Histórico</a>
                    <?php } ?>
                </div>
            </div>

            <div class="card col-3">
                <div class="card-header">
                    <b><?php echo ($nome_fumo . ": " . $valor_fumo . "%"); ?></b>
                </div>
                <div class="card-body">
                    <img <?php if ($valor_fumo <= 50) { ?>src="images/Fumo.png" <?php } else { ?>src="images/Fumo_alto.png" <?php } ?> class="card-img" alt="Logotipo fumo">
                </div>
                <div class="card-footer">
                    <b>Última Atualização: </b>
                    <?php echo ($hora_fumo);
                    if ($_SESSION['admin'] == 1) { ?>
                        <a href="historico.php?dispositivo=fumo">Histórico</a>
                    <?php } ?>
                </div>
            </div>

            <div class="row" style="text-align: center;">
                <!--Ficha8-->
                <div class="card col-3">
                    <div class="card-header">
                        <!--Titulo Sensor e Valor apresentado-->
                        <b><?php //echo ($nome_movimento . ": ");
                        if ($valor_movimento == 1) {
                            echo ("Com Movimento");
                        } else {
                            echo ("Sem Movimento");
                        } ?></b>
                    </div>
                    <div class="card-body">
                        <!--Imagem Logotipo-->
                        <?php if ($valor_movimento == 1) {
                        ?>
                            <img src="images/movimento.png" class="card-img" alt="Logotipo movimento">
                        <?php
                        } else {
                        ?>
                            <img src="images/sem_movimento.png" class="card-img" alt="Logotipo sem_movimento">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <!--Ultima atualização do sensor e link para respetivo Histórico apenas para "admins"-->
                        <b>Última Atualização: </b>
                        <?php echo ($hora_movimento);
                        if ($_SESSION['admin'] == 1) { ?>
                            <a href="historico.php?dispositivo=movimento">Histórico</a>
                        <?php } ?>
                    </div>
                </div>

                <div class="card col-3">
                    <div class="card-header">
                        <!--Titulo Sensor e Valor apresentado-->
                        <b><?php echo ($nome_camara); ?></b>
                    </div>
                    <div class="card-body">
                        <!--Imagem Logotipo-->
                        <?php
                        echo "<img src='api/files/camara/camara.jpg?id=" . time() . "' style='width:100%'>" //para nao ficar a imagem antiga na cache do browser      //<img src="images/camara.jpg" class="card-img" alt="Logotipo camara">
                        ?>
                    </div>
                    <div class="card-footer">
                        <!--Ultima atualização do sensor e link para respetivo Histórico apenas para "admins"-->
                        <b>Última Fotografia Tirada: </b>
                        <?php echo ($hora_camara);
                        if ($_SESSION['admin'] == 1) { ?>
                            <a href="historico.php?dispositivo=camara">Histórico</a>
                        <?php } ?>
                    </div>
                </div>

                <div class="card col-3">
                    <div class="card-header">
                        <b><?php echo ($nome_porta . ": ");
                            if ($valor_porta == 0) {
                                echo ("Fechada");
                            } else {
                                echo ("Aberta");
                            }; ?></b>
                    </div>
                    <div class="card-body">
                        <img <?php if ($valor_porta == 1) { ?>src="images/Porta.png" <?php } else { ?>src="images/Porta_fechada.png" <?php } ?> class="card-img" alt="Logotipo porta">
                    </div>
                    <div class="card-footer">
                        <b>Última Atualização: </b>
                        <?php echo ($hora_porta);
                        if ($_SESSION['admin'] == 1) { ?>
                            <a href="historico.php?dispositivo=porta">Histórico</a>
                        <?php } ?>
                    </div>
                </div>

                <div class="card col-3">
                    <div class="card-header">
                        <b><?php echo ($nome_estores . ": ");
                            if ($valor_estores == 0) {
                                echo ("Fechados");
                            } elseif ($valor_estores == 1) {
                                echo ("Entreabertos");
                            } else {
                                echo ("Abertos");
                            } ?></b>
                    </div>
                    <div class="card-body">
                        <img <?php if ($valor_estores == 1) { ?>src="images/Estores.png" <?php } elseif ($valor_estores == 2) { ?>src="images/Estores_abertos.png" <?php } else { ?>src="images/Estores_fechados.png" <?php } ?> class="card-img" alt="Logotipo estores">
                    </div>
                    <div class="card-footer">
                        <b>Última Atualização: </b>
                        <?php echo ($hora_estores);
                        if ($_SESSION['admin'] == 1) { ?>
                            <a href="historico.php?dispositivo=estores">Histórico</a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>

        <!--Tabela de Sensores:-->
        <div class="container" style="margin-top: 20px;">
            <div class="card">
                <div class="card-header"><b>Tabela de Sensores</b></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de Dispositivo IoT</th>
                                <th>Data de Atualização</th>
                                <th>Valor</th>
                                <th>Estado Alertas</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><?php echo $nome_luminosidade; ?></td>
                            <td><?php echo $hora_luminosidade; ?></td>
                            <td><?php if ($valor_luminosidade == 1) {
                                    echo ("Alta");
                                } else {
                                    echo ("Baixa");
                                } ?></td>
                            <td><?php if ($valor_luminosidade == "0") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } ?>
                                <!--Apresenta o alerta a partir do valor (%) escolhido-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_temperatura; ?></td>
                            <td><?php echo $hora_temperatura; ?></td>
                            <td><?php echo $valor_temperatura; ?> °C</td>
                            <td><?php if ($valor_temperatura > "16" &&   $valor_temperatura < "33") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } elseif ($valor_temperatura > "0" && $valor_temperatura < "38") { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-danger">PERIGO</span><?php } ?>
                                <!--Apresenta o alerta "PERIGO" se a temperatura for menor que 0 ou maior que 38, ou o alerta "Cuidado" se estiver entre 0 e 16 ou 33 e 38-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_humidade; ?></td>
                            <td><?php echo $hora_humidade; ?></td>
                            <td><?php echo $valor_humidade; ?> %</td>
                            <td><?php if ($valor_humidade <= "75") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } ?>
                                <!--Apresenta o alerta a partir do valor escolhido-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_fumo; ?></td>
                            <td><?php echo $hora_fumo; ?></td>
                            <td><?php echo $valor_fumo; ?> %</td>
                            <td><?php if ($valor_fumo <= "10") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } elseif ($valor_fumo <= "50") { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-danger">PERIGO</span><?php } ?>
                                <!--Apresenta o alerta "Cuidado" ou "PERIGO" consoante a % de fumo-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_movimento; ?></td>
                            <td><?php echo $hora_movimento; ?></td>
                            <td><?php if ($valor_movimento == 1) {
                                    echo ("Com Movimento");
                                } else {
                                    echo ("Sem Movimento");
                                } ?></td>
                            <td><?php if ($valor_movimento == "0") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } else{ ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php }?>
                                <!--Apresenta o alerta "Cuidado" ou "OK" consoante se ha movimento ou nao-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_porta; ?></td>
                            <td><?php echo $hora_porta; ?></td>
                            <td><?php if ($valor_porta == 0) {
                                    echo ("Fechada");
                                } else {
                                    echo ("Aberta");
                                } ?></td>
                            <td><?php if ($valor_porta == "0") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } ?>
                                <!--Apresenta o alerta se a porta estiver aberta-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_estores; ?></td>
                            <td><?php echo $hora_estores; ?></td>
                            <td><?php if ($valor_estores == "0") {
                                    echo ("Fechados");
                                } elseif ($valor_estores == "1") {
                                    echo ("Entreabertos");
                                } else {
                                    echo ("Abertos");
                                } ?></td>
                            <td><?php if ($valor_estores == "0") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } ?>
                                <!--Apresenta o alerta se os estores estiverem abertos-->
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $nome_nivelagua; ?></td>
                            <td><?php echo $hora_nivelagua; ?></td>
                            <td><?php if ($valor_nivelagua == 0) {
                                    echo ("Baixo");
                                } else {
                                    echo ("Alto");
                                } ?></td>
                            <td><?php if ($valor_nivelagua == "0") { ?>
                                    <span class="badge rounded-pill bg-success">OK</span><?php } else { ?>
                                    <span class="badge rounded-pill bg-warning text-dark">Cuidado</span><?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <!--Tabela de Atuadores:
        Nesta tabela os "badges" dos "valores da última ação" estão com o seguinte código de cores:
            preto: ligar/abrir
            cinzento: desligar/fechar
            amarelo: ação a ter atenção
            vermelho: alerta 
        Os botões para ativar ou desativar os atuadores são aqui preservados para a Fase 2 do projeto, mas apenas para os utilizadores com privilégios de "admin"-->
        <?php if ($_SESSION['admin'] == 1) { ?>

            <div class="container" style="margin-top: 20px;">
                <div class="card">
                    <div class="card-header"><b>Tabela de Atuadores</b></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo de Dispositivo IoT</th>
                                    <th>Data de Última Ação</th>
                                    <th>Valor Última Ação</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $nome_ventilacao; ?></td>
                                <!--Nome respetivo atuador-->
                                <td><?php echo $hora_ventilacao; ?></td>
                                <!--Data da ultima ação do respetivo atuador-->
                                <td><?php if ($valor_ventilacao == "1") { ?>
                                        <span class="badge rounded-pill bg-dark">Ligar</span><?php } else { ?>
                                        <!--Valores da Última Ação-->
                                        <span class="badge rounded-pill bg-secondary">Desligar</span><?php } ?>
                                </td>
                                <td>
                                <button onclick="desligarVentilacao();" id="desligarVentilacao" class="btn btn-outline-info botao-ligar">Desligar</button>
                                    <!--Botões de Ligar/Desligar-->
                                    <button onclick="ligarVentilacao();" id="ligarVentilacao" class="btn btn-info botao-ligar">Ligar</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_arcondicionado; ?></td>
                                <td><?php echo $hora_arcondicionado; ?></td>
                                <td><?php if ($valor_arcondicionado == "3") { ?>
                                        <span class="badge rounded-pill bg-dark">Auto</span><?php } elseif ($valor_arcondicionado == "2") { ?><!--Tal como nos outros atuadores, escolhe-se o "badge" consoante o valor-->
                                        <span class="badge rounded-pill bg-danger">Aquecer</span><?php } elseif($valor_arcondicionado == "1"){ ?>
                                        <span class="badge rounded-pill bg-primary">Arrefecer</span><?php } else{?>
                                        <span class="badge rounded-pill bg-secondary">Desligar</span><?php 
                                        }?>
                                </td>
                                <td><button onclick="desligarArCondicionado();" id="desligarArCondicionado" class="btn btn-outline-info botao-ligar">Desligar</button>
                                    <button onclick="ligarArCondicionadoFrio();" id="ligarArCondicionadoFrio" class="btn btn-info botao-ligar">Arrefecer</button>
                                    <button onclick="ligarArCondicionadoQuente();" id="ligarArCondicionadoQuente" class="btn btn-info botao-ligar">Aquecer</button>
                                    <button onclick="ligarArCondicionadoAuto();" id="ligarArCondicionadoAuto" class="btn btn-info botao-ligar">Automatico</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_dreno; ?></td>
                                <td><?php echo $hora_dreno; ?></td>
                                <td><?php if ($valor_dreno == "1") { ?><!--Condições para apresentar respetivo "badge" de alerta-->
                                        <span class="badge rounded-pill bg-dark">Abrir</span><?php } else { ?>
                                        <span class="badge rounded-pill bg-secondary">Fechar</span><?php } ?>
                                </td>
                                <td><button onclick="desligarDreno();" id="desligarDreno" class="btn btn-outline-info botao-ligar">Fechar</button><!--Botão-->
                                    <button onclick="ligarDreno();" id="ligarDreno" class="btn btn-info botao-ligar">Abrir</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_chuveiros; ?></td>
                                <td><?php echo $hora_chuveiros; ?></td>
                                <td><?php if ($valor_chuveiros == "1") { ?><!--Condições para apresentar respetivo "badge" de alerta-->
                                        <span class="badge rounded-pill bg-danger">Abrir</span><?php } else { ?>
                                        <span class="badge rounded-pill bg-secondary">Fechar</span><?php } ?>
                                </td>
                                <td><button onclick="desligarChuveiros();" id="desligarChuveiros" class="btn btn-outline-info botao-ligar">Desligar</button><!--Botão-->
                                    <button onclick="ligarChuveiros();" id="ligarChuveiros" class="btn btn-info botao-ligar">Ligar</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_fechadura; ?></td>
                                <td><?php echo $hora_fechadura; ?></td>
                                <td><?php if ($valor_fechadura == "1") { ?><!--Condições para apresentar respetivo "badge" de alerta-->
                                        <span class="badge rounded-pill bg-warning text-dark">Abrir</span><?php } else { ?>
                                        <span class="badge rounded-pill bg-secondary">Fechar</span><?php } ?>
                                </td>
                                <td><button onclick="fecharPorta();" id="fecharPorta" class="btn btn-outline-info botao-ligar">Fechar</button><!--Botão-->
                                    <button onclick="abrirPorta();" id="abrirPorta" class="btn btn-info botao-ligar">Abrir</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_motorestores; ?></td>
                                <td><?php echo $hora_motorestores; ?></td>
                                <td><?php if ($valor_motorestores == "2") { ?><!--Condições para apresentar respetivo "badge" de alerta-->
                                        <span class="badge rounded-pill bg-dark">Abrir Tudo</span><?php } elseif ($valor_motorestores == "1") { ?>
                                        <span class="badge rounded-pill bg-dark">Abrir Metade</span><?php } else { ?>
                                        <span class="badge rounded-pill bg-secondary">Fechar</span><?php } ?>
                                </td>
                                <td><button onclick="fecharEstores();" id="fecharEstores" class="btn btn-outline-info botao-ligar">Fechar</button><!--Botão-->
                                    <button onclick="abrirEstoresMeio();" id="abrirEstoresMeio" class="btn btn-info botao-ligar">Abrir Meio</button>
                                    <button onclick="abrirEstoresTudo();" id="abrirEstoresTudo" class="btn btn-info botao-ligar">Abrir Tudo</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_alarme; ?></td>
                                <td><?php echo $hora_alarme; ?></td>
                                <td><?php if ($valor_alarme == "1") { ?><!--Condições para apresentar respetivo "badge" de alerta-->
                                        <span class="badge rounded-pill bg-danger">Ativar</span><?php } else { ?>
                                        <span class="badge rounded-pill bg-secondary">Silenciar</span><?php } ?>
                                </td>
                                <td><button onclick="desligarAlarme();" id="desligarAlarme" class="btn btn-outline-info botao-ligar">Desligar</button><!--Botão-->
                                    <button onclick="ligarAlarme();" id="ligarAlarme" class="btn btn-info botao-ligar">Ligar</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $nome_camara; ?></td>
                                <td><?php echo $hora_camara; ?></td>
                                <td><?php if ($valor_camara == "1") { ?><!--Condições para apresentar respetivo "badge" de alerta-->
                                        <span class="badge rounded-pill bg-dark">Tirar Foto</span><?php } else { ?>
                                        <span class="badge rounded-pill bg-secondary">Desligar</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <!--<button type="button" class="btn btn-outline-info">Silenciar</button>-->
                                    <button onclick="ligarWebcam();" id="ligarWebcam" class="btn btn-info botao-ligar">Tirar Foto</button><!--Botão-->
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        <?php } ?>

</body>

</html>