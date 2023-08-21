<?php
$usuarios = []; // Array para armazenar os usuários em memória
//$_SERVER['REQUEST_METHOD'] == 'POST' && 
if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];

    $novoUsuario = [
        'cpf' => $cpf,
        'nome' => $nome,
        'data_nascimento' => $data_nascimento
    ];

    $usuarios[] = $novoUsuario;

    echo json_encode(['mensagem' => 'Usuário adicionado com sucesso']);
} elseif (isset($_GET['cpf'])) { //$_SERVER['REQUEST_METHOD'] == 'GET' && 
    $cpfConsulta = $_GET['cpf'];

    $usuarioEncontrado = null;
    foreach ($usuarios as $usuario) {
        if ($usuario['cpf'] == $cpfConsulta) {
            $usuarioEncontrado = $usuario;
            break;
        }
    }

    if ($usuarioEncontrado) {
        echo json_encode($usuarioEncontrado);
    } else {
        echo json_encode(['mensagem' => 'Usuario nao encontrado']);
    }
} else {
    echo json_encode(['mensagem' => 'Requisicao invalida']);
    json_last_error_msg();

}

?>
