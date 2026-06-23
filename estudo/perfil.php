<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: painel.php");
    exit;
}

$slug = preg_replace('/[^a-zA-Z0-9_\-]/', '', $_SESSION['usuario']);
$arquivo = "usuarios/" . $slug . "/dados.json";

$email = $telefone = $cep = "Não informado";

if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $dados = json_decode($conteudo, true);
    
    $email = $dados['email'] ?? 'Não informado';
    $telefone = $dados['telefone'] ?? 'Não informado';
    $cep = $dados['cep'] ?? 'Não informado';
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
        <p><strong>Usuário:</strong> <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span></p>
        <p><strong>E-mail:</strong> <span><?php echo htmlspecialchars($email); ?></span></p>
        <p><strong>Telefone:</strong> <span><?php echo htmlspecialchars($telefone); ?></span></p>
        <p><strong>CEP:</strong> <span><?php echo htmlspecialchars($cep); ?></span></p>
      </div>
      
      <a href="logout.php" class="btn-logout">Deslogar / Sair</a>
    </div>
  </main>

</body>
</html>