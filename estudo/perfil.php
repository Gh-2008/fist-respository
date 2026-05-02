<?php
session_start();

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: painel.php");
    exit;
}

$slugUsuario = preg_replace('/[^a-zA-Z0-9_\-]/', '', $_SESSION['usuario_logado']);
$caminho_arquivo = "usuarios/" . $slugUsuario . "/dados.json";

$email = $telefone = $cep = "";

if (file_exists($caminho_arquivo)) {
    $conteudo = file_get_contents($caminho_arquivo);
    $dados_usuario = json_decode($conteudo, true);
    
    $email = $dados_usuario['email'] ?? 'Não informado';
    $telefone = $dados_usuario['telefone'] ?? 'Não informado';
    $cep = $dados_usuario['cep'] ?? 'Não informado';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="perfil.css">
</head>
<body>

  <nav class="navbar-perfil">
    <div class="logo">
      <a href="perfil.php">MeuSite</a>
    </div>
    <div>
      <a href="painel.php" class="btn-voltar">Voltar para Home</a>
    </div>
  </nav>

  <main class="perfil-container">
    <div class="perfil-card">
      <h2>Meu Perfil <span class="avatar">👤</span></h2>
      <div class="divisor"></div>

      <div class="info-group">
        <p><strong>Usuário:</strong> <span><?php echo htmlspecialchars($_SESSION['usuario_logado']); ?></span></p>
        <p><strong>E-mail:</strong> <span><?php echo htmlspecialchars($email); ?></span></p>
        <p><strong>Telefone:</strong> <span><?php echo htmlspecialchars($telefone); ?></span></p>
        <p><strong>CEP:</strong> <span><?php echo htmlspecialchars($cep); ?></span></p>
      </div>
      
      <a href="logout.php" class="btn-logout">Deslogar / Sair</a>
    </div>
  </main>

</body>
</html>