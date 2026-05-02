<?php
session_start();

// Trava de segurança: se não houver sessão ativa, volta para o login
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
  <section id="galeria" class="galeria-section">
    <h2>Destinos Magníficos</h2>
    <p class="sub-galeria">Passe o mouse para expandir a visão e revelar os segredos de cada lugar.</p>
    
    <div class="mosaico-container">
      
      <div class="item-mosaico grande" id="foto-pantanal" style="background-image: url('imgdosite/pantanalimg.jpg');">
        <div class="overlay-info">
          <span class="tag-foto">Centro-Oeste</span>
          <h3>Pantanal</h3>
          <p>O coração pulsante da maior fauna alagada do planeta.</p>
          <span class="btn-ver-mais">Explorar Bioma →</span>
        </div>
      </div>

      <div class="item-mosaico" id="foto-rio" style="background-image: url('imgdosite/riodejaneiroimg.jpg');">
        <div class="overlay-info">
          <span class="tag-foto">Sudeste</span>
          <h3>Rio de Janeiro</h3>
          <p>A simbiose perfeita entre o mar, a floresta urbana e a cultura.</p>
          <span class="btn-ver-mais">Explorar Cidade →</span>
        </div>
      </div>

      <div class="item-mosaico" id="foto-amazonia" style="background-image: url('imgdosite/amazonia.jpg');">
        <div class="overlay-info">
          <span class="tag-foto">Norte</span>
          <h3>Amazônia</h3>
          <p>A imensidão verde e o maior santuário de biodiversidade da Terra.</p>
          <span class="btn-ver-mais">Explorar Floresta →</span>
        </div>
      </div>

      <div class="item-mosaico" id="foto-nordeste" style="background-image: url('imgdosite/lencois.jpg');">
        <div class="overlay-info">
          <span class="tag-foto">Nordeste</span>
          <h3>Lençóis Maranhenses</h3>
          <p>Um deserto mágico repleto de lagoas cristalinas sazonais.</p>
          <span class="btn-ver-mais">Explorar Dunas →</span>
        </div>
      </div>

    </div>
  </section>

  <section id="curiosidades" class="secao-curiosidades">
    <h2>Segredos do Gigante</h2>
    <p class="sub-galeria">Passe o mouse (ou toque) nos cartões para girá-los em 3D.</p>
    
    <div class="container-cards-3d">
      <div class="card-3d">
        <div class="card-inner">
          <div class="card-front">
            <div class="card-front-content">
              <span class="card-numero">01</span>
              <h3>A Maior do Mundo</h3>
              <p>Você sabe qual recorde absoluto o Rio Amazonas detém?</p>
              <span class="hint-flip">Girar Carta ↻</span>
            </div>
          </div>
          <div class="card-back">
            <div class="card-back-content">
              <h3>Volume de Água!</h3>
              <p>O Rio Amazonas descarrega mais água no oceano do que os próximos sete maiores rios do mundo combinados!</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card-3d">
        <div class="card-inner">
          <div class="card-front">
            <div class="card-front-content">
              <span class="card-numero">02</span>
              <h3>Patrimônio Isolado</h3>
              <p>Existe uma ilha proibida que guarda uma densidade mortal.</p>
              <span class="hint-flip">Girar Carta ↻</span>
            </div>
          </div>
          <div class="card-back">
            <div class="card-back-content">
              <h3>Ilha das Cobras!</h3>
              <p>A Ilha da Queimada Grande possui cerca de 1 a 5 jararacas-ilhoas por metro quadrado. O acesso humano é proibido.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card-3d">
        <div class="card-inner">
          <div class="card-front">
            <div class="card-front-content">
              <span class="card-numero">03</span>
              <h3>Floresta Urbana</h3>
              <p>Onde fica o maior pulmão verde dentro de uma capital?</p>
              <span class="hint-flip">Girar Carta ↻</span>
            </div>
          </div>
          <div class="card-back">
            <div class="card-back-content">
              <h3>Floresta da Tijuca!</h3>
              <p>Localizada no Rio de Janeiro, é uma das maiores florestas urbanas do mundo replantada inteiramente pelo homem no século XIX.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="experiencias" class="experiencias">
    <div class="card-exp">
      <div class="card-icon">🌲</div>
      <h3>Biodiversidade</h3>
      <p>A maior floresta tropical do mundo e santuários ecológicos intocados.</p>
      <div class="barra-interativa-card"></div>
    </div>
    <div class="card-exp">
      <div class="card-icon">🌊</div>
      <h3>Litoral Infinito</h3>
      <p>Mais de 7 mil quilômetros de praias que vão do rústico ao paradisíaco.</p>
      <div class="barra-interativa-card azul"></div>
    </div>
    <div class="card-exp">
      <div class="card-icon">🥁</div>
      <h3>Cultura Viva</h3>
      <p>Uma riqueza gastronômica, musical e histórica única no planeta.</p>
      <div class="barra-interativa-card amarelo"></div>
    </div>
  </section>

  <footer>
    <p>&copy; 2026 Descubra o Brasil. Portal Interativo do Usuário.</p>
  </footer>

</body>
</html>