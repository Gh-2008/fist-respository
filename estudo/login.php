<?php
// 1. Inicia a sessão na primeiríssima linha para garantir que o servidor grave os dados
session_start();

// Configura a resposta para formato JSON (padrão de mercado para AJAX)
header('Content-Type: application/json; charset=utf-8');

// Pega os dados enviados pelo JavaScript (Fetch)
$json = file_get_contents('php://input');
$dados = json_decode($json, true);

// Validação básica de segurança
if (!$dados || empty($dados['usuario']) || empty($dados['senha'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['mensagem' => 'Por favor, preencha todos os campos.']);
    exit;
}

$usuario_digitado = trim($dados['usuario']);
$senha_digitada = $dados['senha'];

// Limpa o nome do usuário para buscar a pasta do mesmo jeito que foi criada no cadastro
$slugUsuario = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuario_digitado);
$caminho_pasta = "usuarios/" . $slugUsuario;
$caminho_arquivo = $caminho_pasta . "/dados.json";

// Verifica se a pasta e o arquivo de dados desse usuário existem
if (!is_dir($caminho_pasta) || !file_exists($caminho_arquivo)) {
    http_response_code(401); // Unauthorized
    echo json_encode(['mensagem' => 'Usuário ou senha incorretos.']);
    exit;
}

// Lê o arquivo JSON com os dados cadastrados do usuário
$conteudo_arquivo = file_get_contents($caminho_arquivo);
$dados_cadastrados = json_decode($conteudo_arquivo, true);

// CONFERÊNCIA DA SENHA CRIPTOGRAFADA
if (password_verify($senha_digitada, $dados_cadastrados['senha'])) {
    
    // =========================================================================
    // CORREÇÃO AQUI: Mudamos para $_SESSION['usuario'] para o painel.php aceitar!
    // =========================================================================
    $_SESSION['usuario'] = $dados_cadastrados['usuario'];
    $_SESSION['email_logado'] = $dados_cadastrados['email']; // Mantido caso use em outro lugar

    http_response_code(200); // OK
    echo json_encode(['mensagem' => 'Login bem-sucedido! Redirecionando...']);
} else {
    // Se a senha estiver errada, damos a mesma mensagem por segurança
    http_response_code(401); 
    echo json_encode(['mensagem' => 'Usuário ou senha incorretos.']);
}
?>