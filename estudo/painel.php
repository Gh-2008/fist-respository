<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Interativo | Descubra o Brasil</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>

  <div class="bg-glow-blobs">
    <div class="blob azul"></div>
    <div class="blob verde"></div>
    <div class="blob amarelo"></div>
  </div>

  <nav class="navbar">
    <div class="nav-logo">Brasil<span>.io</span></div>
    <div class="nav-links-interativos">
      <a href="#galeria" class="link-efeito">Galeria</a>
      <a href="#curiosidades" class="link-efeito">Curiosidades</a>
      <a href="#experiencias" class="link-efeito">Experiências</a>
    </div>
    <div class="nav-usuario">
      Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>!
      <a href="logout.php" class="btn-sair">Sair</a>
    </div>
  </nav>

  <header class="hero">
    <div class="hero-content">
      <span class="badge">Aventura Interativa</span>
      <h1 class="efeito-digitar">Descubra o Inesperado.</h1>
      <p>Uma mistura infinita de cores, ritmos e biomas que se transformam a cada quilômetro. Passe o mouse e explore.</p>
      <a href="#galeria" class="btn-explorar-premium">
        <span>Começar Jornada</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <div class="scroll-indicator">
      <div class="mouse">
        <div class="wheel"></div>
      </div>
    </div>
  </header>

  <img src="banner.jpg" alt="Banner Principal">
</body>
</html>