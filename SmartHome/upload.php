<?php
//Código para fazer upload de imagem
//Fazer o Post:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['imagem'])) {
    print_r($_FILES['imagem']['name']);
    echo ("***");
    print_r($_FILES['imagem']['size']);
    echo ("***");
    print_r($_FILES['imagem']['type']);
    move_uploaded_file($_FILES['imagem']['tmp_name'], "api/files/camara/camara.jpg");
    
    } else {
        echo ("Não existe imagem");
        http_response_code(400); //Código 400 - Bad Request
    }
} else {
    echo ("Metodo nao permitido");
    http_response_code(405); //Código 405 - Method Not Allowed
}

?>