<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$json = file_get_contents('php://input');
$dados = json_decode($json, true);

if (!$dados || empty($dados['usuario']) || empty($dados['senha'])) {
    http_response_code(400);
    echo json_encode(['mensagem' => 'Por favor, preencha todos os campos.']);
    exit;
}

$usuario = trim($dados['usuario']);
$senha = $dados['senha'];

$slug = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuario);
$pasta = "usuarios/" . $slug;
$arquivo = $pasta . "/dados.json";

if (!is_dir($pasta) || !file_exists($arquivo)) {
    http_response_code(401);
    echo json_encode(['mensagem' => 'Usuário ou senha incorretos.']);
    exit;
}

$conteudo = file_get_contents($arquivo);
$dadosUsuario = json_decode($conteudo, true);

if (password_verify($senha, $dadosUsuario['senha'])) {
    $_SESSION['usuario'] = $dadosUsuario['usuario'];
    $_SESSION['email_logado'] = $dadosUsuario['email'];

    http_response_code(200);
    echo json_encode(['mensagem' => 'Login bem-sucedido! Redirecionando...']);
} else {
    http_response_code(401);
    echo json_encode(['mensagem' => 'Usuário ou senha incorretos.']);
}
?>