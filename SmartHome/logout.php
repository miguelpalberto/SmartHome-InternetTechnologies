<?php
    session_start();       // diz ao browser para utilizar variáveis de sessão;
    session_unset();     // remove todas as variáveis de sessão;
    session_destroy();  // destrói a sessão

    header( "refresh:0.5;url=index.php" ); //remeter para o index.php
?>