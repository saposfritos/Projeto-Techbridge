<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meus Cursos - TechBridge</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/index.css"> <!-- Reutilizando o CSS principal -->
  <link rel="stylesheet" href="style/meus_cursos.css"> <!-- CSS específico para esta página -->
</head>
<body>
  <!-- Âncora topo -->
  <div id="topo"></div>

  <!-- ===== HEADER ===== -->
  <header class="topo" id="header">
    <nav class="navbar">
      <div class="logo-section">
        <a href="home.php">
          <img src="images/image-removebg-preview.png" alt="TechBridge Logo" class="imagemlogo">
        </a>
      </div>

      <!-- Barra de Pesquisa -->
      <div class="search-container">
        <form class="search-form" onsubmit="return false;">
          <input 
            type="text" 
            class="search-input" 
            placeholder="Pesquisar por qualquer curso"
            id="search-input"
          >
          <button type="submit" class="search-btn">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>

      <!-- Links de Navegação -->
   <?php if (!isset($_SESSION['usuario'])): ?>
      <!-- Não logado -->
      <div class="nav-links">
        <div class="auth-buttons">
          <a href="login.php" class="login-btn">Fazer login</a>
          <a href="cadastro.php" class="signup-btn">Inscreva-se</a>
        </div>
      </div>
    <?php elseif ( $_SESSION['Acesso'] == 1): ?>
      <!-- Admin -->
      <div class="nav-links">
            <a href="addcurso.php" class="teach-link">Adicionar Cursos</a>
            <a href="cursos.php" class="my-courses-link">Cursos</a>
            <a href="ensine.php" class="teach-link">Ensine na TechBridge</a>
            <a href="meus_cursos.php" class="my-courses-link">Meus Cursos</a>
            <div class="profile-section">
                <a href="perfil.php" class="profile-link">
                    <i class="fas fa-user-circle"></i>
                    <span><?= htmlspecialchars($_SESSION['nome']) ?></span>
                </a>
            </div>
        </div>
    <?php else: ?>
      <!-- Usuário comum -->
      <div class="nav-links">
            <a href="ensine.php" class="teach-link">Ensine na TechBridge</a>
            <a href="cursos.php" class="my-courses-link">Cursos</a>
            <a href="meus_cursos.php" class="my-courses-link">Meus Cursos</a>
            <div class="profile-section">
                <a href="perfil.php" class="profile-link">
                    <i class="fas fa-user-circle"></i>
                    <span><?= htmlspecialchars($_SESSION['nome']) ?></span>
                </a>
            </div>
        </div>
    <?php endif; ?>
  </nav>
</header>

  <!-- ===== MAIN ===== -->
  <main>
    <div class="content-wrapper">
      <section id="meus-cursos-header">
        <h1>Meus Cursos</h1>
        <p>Acompanhe seu progresso e acesse seus cursos.</p>
      </section>
      <section id="course-list">
        <h2>Cursos em Andamento</h2>
        <div class="courses-grid">
          <!-- Exemplo de Card de Curso (será preenchido dinamicamente) -->
          <div class="course-card">
            <img src="images/logica-de-programacao-na-pratica.jpg" alt="Lógica de Programação" class="course-image">
            <div class="course-content">
              <h3 class="course-title">Lógica de Programação na Prática</h3>
              <p class="course-description">Aprenda os fundamentos da lógica de programação com exemplos práticos.</p>
              <div class="course-meta">
                <div class="course-instructor">
                  <div class="instructor-avatar">I</div>
                  <span>Instrutor Exemplo</span>
                </div>
                <div class="course-progress">
                  <span>Progresso: 75%</span>
                  <div class="progress-bar"><div style="width: 75%;"></div></div>
                </div>
              </div>
              <a href="#" class="continue-btn">Continuar Curso</a>
            </div>
          </div>

          <div class="course-card">
            <img src="images/ia.jpg" alt="Inteligência Artificial" class="course-image">
            <div class="course-content">
              <h3 class="course-title">Introdução à Inteligência Artificial</h3>
              <p class="course-description">Explore os conceitos básicos de IA e suas aplicações.</p>
              <div class="course-meta">
                <div class="course-instructor">
                  <div class="instructor-avatar">I</div>
                  <span>Instrutor Exemplo</span>
                </div>
                <div class="course-progress">
                  <span>Progresso: 50%</span>
                  <div class="progress-bar"><div style="width: 50%;"></div></div>
                </div>
              </div>
              <a href="#" class="continue-btn">Continuar Curso</a>
            </div>
          </div>

          <div class="course-card">
            <img src="images/php.jpg" alt="PHP" class="course-image">
            <div class="course-content">
              <h3 class="course-title">Desenvolvimento Web com PHP</h3>
              <p class="course-description">Crie aplicações web dinâmicas usando PHP e MySQL.</p>
              <div class="course-meta">
                <div class="course-instructor">
                  <div class="instructor-avatar">I</div>
                  <span>Instrutor Exemplo</span>
                </div>
                <div class="course-progress">
                  <span>Progresso: 25%</span>
                  <div class="progress-bar"><div style="width: 25%;"></div></div>
                </div>
              </div>
              <a href="#" class="continue-btn">Continuar Curso</a>
            </div>
          </div>

        </div>
      </section>
    </div>
  </main>

  <!-- BOTÃO TOPO -->
  <a href="#topo" id="btn-topo" title="Voltar ao topo"><i class="fas fa-arrow-up"></i></a>

  <!-- ===== FOOTER ===== -->
  <footer>
    <div class="container--footer">
      <div class="redes">
        <a href="https://www.instagram.com/eniac.oficial/" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.youtube.com/@eniac.oficial" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
        <a href="https://www.facebook.com/eniac.oficial/?locale=pt_BR" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
      </div>
      <p>&copy; 2025 Meu Curso Online. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- ===== SCRIPT ===== -->
  <script>
    /* ===== MENU TOGGLE ===== */
    const menuBtn = document.getElementById("menu-btn");
    
    if (menuBtn) {
      menuBtn.addEventListener("click", () => {
        // Aqui você pode adicionar funcionalidade para o menu dropdown
        console.log("Menu clicado");
      });
    }

    /* ===== BARRA DE PESQUISA ===== */
    const searchInput = document.getElementById("search-input");
    const searchForm = document.querySelector(".search-form");
    
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const searchTerm = searchInput.value.trim();
      if (searchTerm) {
        console.log("Pesquisando por:", searchTerm);
        // Aqui você pode adicionar a lógica de pesquisa
      }
    });

    /* ===== BOTÃO TOPO VISIBILIDADE ===== */
    const btnTopo = document.getElementById("btn-topo");
    
    window.addEventListener("scroll", () => {
      btnTopo.classList.toggle("show", window.scrollY > 300);
    });
  </script>
</body>
</html>

