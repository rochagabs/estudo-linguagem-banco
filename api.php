<?php
$usuarios = [];

function salvarUsuarios() {
    global $usuarios;
    $json = json_encode($usuarios, JSON_PRETTY_PRINT);
    file_put_contents('usuarios.json', $json);
}

function carregarUsuarios() {
    global $usuarios;
    if (file_exists('usuarios.json')) {
        $json = file_get_contents('usuarios.json');
        $usuarios = json_decode($json, true);
    }
}

carregarUsuarios();

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

    salvarUsuarios();

    echo json_encode(['mensagem' => 'Usuário adicionado com sucesso']);
} elseif (isset($_GET['cpf'])) {
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
}

?>

