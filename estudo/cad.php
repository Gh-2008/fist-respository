<?php
// Configura a aplicação para responder como uma API JSON profissional
header('Content-Type: application/json; charset=utf-8');

// Captura a requisição JSON enviada no corpo (Padrão hoje em dia)
$json = file_get_contents('php://input');
$dados = json_decode($json, true);

// Validação básica se os dados existem
if (!$dados || empty($dados['usuario']) || empty($dados['senha'])) {
    http_response_code(400); // Bad Request (Requisição mal feita)
    echo json_encode(['mensagem' => 'Parâmetros obrigatórios ausentes.']);
    exit;
}

// Organização das variáveis
$usuario = trim($dados['usuario']);
$email = filter_var($dados['email'], FILTER_VALIDATE_EMAIL);
$telefone = $dados['telefone'];
$cep = $dados['cep'];

// Se o e-mail for inválido, quebra aqui
if (!$email) {
    http_response_code(400);
    echo json_encode(['mensagem' => 'Formato de e-mail inválido.']);
    exit;
}

// Criptografia usando a tecnologia nativa recomendada hoje (Bcrypt por padrão)
$senhaCriptografada = password_hash($dados['senha'], PASSWORD_DEFAULT);

// Tratamento do nome da pasta (Segurança contra invasão de diretório)
$slugUsuario = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuario);
$diretorioUsuario = "usuarios/" . $slugUsuario;

// Verifica duplicidade
if (is_dir($diretorioUsuario)) {
    http_response_code(409); // Conflict (O recurso já existe)
    echo json_encode(['mensagem' => 'Este nome de usuário já está em uso.']);
    exit;
}

// Criação da pasta com permissões modernas de segurança (0755)
if (mkdir($diretorioUsuario, 0755, true)) {
    
    // Payload que será persistido no arquivo do usuário
    $dadosParaSalvar = [
        'usuario' => $usuario,
        'email' => $email,
        'telefone' => $telefone,
        'cep' => $cep,
        'senha' => $senhaCriptografada,
        'criado_em' => date('Y-m-d H:i:s') // Registra o momento exato do cadastro
    ];

    // Salva o JSON formatado e limpo dentro da pasta
    file_put_contents($diretorioUsuario . "/dados.json", json_encode($dadosParaSalvar, JSON_PRETTY_PRINT));

    http_response_code(201); // Created (Criado com sucesso!)
    echo json_encode(['mensagem' => 'Cadastro concluído com sucesso!']);
} else {
    http_response_code(500); // Internal Server Error (Erro no seu servidor)
    echo json_encode(['mensagem' => 'Falha crítica ao gerar o diretório do usuário.']);
}