<?php
header('Content-Type: application/json; charset=utf-8');

$json = file_get_contents('php://input');
$dados = json_decode($json, true);

if (!$dados || empty($dados['usuario']) || empty($dados['senha'])) {
    http_response_code(400);
    echo json_encode(['mensagem' => 'Parâmetros obrigatórios ausentes.']);
    exit;
}

$usuario = trim($dados['usuario']);
$email = filter_var($dados['email'], FILTER_VALIDATE_EMAIL);
$telefone = $dados['telefone'] ?? '';
$cep = $dados['cep'] ?? '';

if (!$email) {
    http_response_code(400);
    echo json_encode(['mensagem' => 'Formato de e-mail inválido.']);
    exit;
}

$senhaCriptografada = password_hash($dados['senha'], PASSWORD_DEFAULT);

$slugUsuario = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuario);
$diretorio = "usuarios/" . $slugUsuario;

if (is_dir($diretorio)) {
    http_response_code(409);
    echo json_encode(['mensagem' => 'Este nome de usuário já está em uso.']);
    exit;
}

if (mkdir($diretorio, 0755, true)) {
    $dadosSalvar = [
        'usuario' => $usuario,
        'email' => $email,
        'telefone' => $telefone,
        'cep' => $cep,
        'senha' => $senhaCriptografada,
        'criado_em' => date('Y-m-d H:i:s')
    ];

    file_put_contents($diretorio . "/dados.json", json_encode($dadosSalvar, JSON_PRETTY_PRINT));

    http_response_code(201);
    echo json_encode(['mensagem' => 'Cadastro concluído com sucesso!']);
} else {
    http_response_code(500);
    echo json_encode(['mensagem' => 'Falha ao criar pasta do usuário.']);
}
?>