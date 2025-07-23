<?php
include('conexao.php');
session_start();

$usuario = [
    'nome' => '',
    'email' => '',
    'Acesso' => ''
];

if (isset($_SESSION['usuario'])) {
    $id = $_SESSION['usuario'];
    $nome = $_SESSION['nome'];
    $_SESSION['Acesso'] = 1;

    $stmt = $mysqli->prepare("SELECT nome, email, Acesso FROM usuario WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['Acesso'] = $usuario['Acesso'];
        $_SESSION['nome'] = $usuario['nome'];
    }
}
?>
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu Curso Online</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/index.css">
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
   <?php if (!isset($_SESSION["usuario"])): ?>
      <!-- Não logado -->
      <div class="nav-links">
        <div class="auth-buttons">
          <a href="login.php" class="login-btn">Fazer login</a>
          <a href="cadastro.php" class="signup-btn">Inscreva-se</a>
        </div>
      </div>
    <?php elseif ( $_SESSION["Acesso"] == 1): ?>
      <!-- Admin -->
      <div class="nav-links">
            <a href="addcurso.php" class="teach-link">Adicionar Cursos</a>
            <a href="cursos.php" class="my-courses-link">Cursos</a>
            <a href="ensine.php" class="teach-link">Ensine na TechBridge</a>
     
            <div class="profile-section">
                <a href="perfil.php" class="profile-link">
                    <i class="fas fa-user-circle"></i>
                    <span><?= htmlspecialchars($_SESSION["nome"]) ?></span>
                </a>
            </div>
        </div>
    <?php else: ?>
      <!-- Usuário comum -->
      <div class="nav-links">
            <a href="ensine.php" class="teach-link">Ensine na TechBridge</a>
            <a href="cursos.php" class="my-courses-link">Cursos</a>
 
            <div class="profile-section">
                <a href="perfil.php" class="profile-link">
                    <i class="fas fa-user-circle"></i>
                    <span><?= htmlspecialchars($_SESSION["nome"]) ?></span>
                </a>
            </div>
        </div>
    <?php endif; ?>
  </nav>
</header>
  

  <!-- ===== MAIN ===== -->
  <main>
    <div class="content-wrapper">
      <!-- ===== HOME ===== -->
      <section id="home">
        <div class="carousel-container">
          <div class="carousel-slide active"><img src="images/im1.jpg" alt="Curso 1"></div>
          <div class="carousel-slide"><img src="images/im2.jpg" alt="Curso 2"></div>
          <div class="carousel-slide"><img src="images/im3.jpg" alt="Curso 3"></div>
          <div class="carousel-slide"><img src="images/im4.jpg" alt="Curso 4"></div>
          <div class="carousel-slide"><img src="images/im5.jpg" alt="Curso 5"></div>
          <button class="arrow left" aria-label="Slide anterior">&#10094;</button>
          <button class="arrow right" aria-label="Próximo slide">&#10095;</button>
        </div>
      </section>

      <!-- ===== SEÇÃO DE CURSOS ===== -->
      <section id="cursos">
        <div class="courses-container">
          <div class="courses-header">
            <h2 class="courses-title">Nossos Cursos</h2>
            <p class="courses-subtitle">
              Descubra uma ampla variedade de cursos online para impulsionar sua carreira e desenvolver novas habilidades tecnológicas.
            </p>
          </div>

          <div class="courses-grid">
            <!-- Curso Placeholder 1 -->
            <div class="course-card placeholder">
              <div class="course-image"></div>
              <div class="course-content">
                <span class="course-category">Programação</span>
                <h3 class="course-title">Curso em Desenvolvimento</h3>
                <p class="course-description">
                  Este espaço está reservado para um novo curso que será lançado em breve. Fique atento às novidades!
                </p>
                <div class="course-meta">
                  <div class="course-instructor">
                    <div class="instructor-avatar">?</div>
                    <span>Instrutor em breve</span>
                  </div>
                  <div class="course-rating">
                    <i class="fas fa-star"></i>
                    <span>--</span>
                  </div>
                </div>
                <div class="course-price">Em breve</div>
              </div>
            </div>

            <!-- Curso Placeholder 2 -->
            <div class="course-card placeholder">
              <div class="course-image"></div>
              <div class="course-content">
                <span class="course-category">Web Design</span>
                <h3 class="course-title">Curso em Desenvolvimento</h3>
                <p class="course-description">
                  Este espaço está reservado para um novo curso que será lançado em breve. Fique atento às novidades!
                </p>
                <div class="course-meta">
                  <div class="course-instructor">
                    <div class="instructor-avatar">?</div>
                    <span>Instrutor em breve</span>
                  </div>
                  <div class="course-rating">
                    <i class="fas fa-star"></i>
                    <span>--</span>
                  </div>
                </div>
                <div class="course-price">Em breve</div>
              </div>
            </div>

            <!-- Curso Placeholder 3 -->
            <div class="course-card placeholder">
              <div class="course-image"></div>
              <div class="course-content">
                <span class="course-category">Data Science</span>
                <h3 class="course-title">Curso em Desenvolvimento</h3>
                <p class="course-description">
                  Este espaço está reservado para um novo curso que será lançado em breve. Fique atento às novidades!
                </p>
                <div class="course-meta">
                  <div class="course-instructor">
                    <div class="instructor-avatar">?</div>
                    <span>Instrutor em breve</span>
                  </div>
                  <div class="course-rating">
                    <i class="fas fa-star"></i>
                    <span>--</span>
                  </div>
                </div>
                <div class="course-price">Em breve</div>
              </div>
            </div>

            <!-- Curso Placeholder 4 -->
            <div class="course-card placeholder">
              <div class="course-image"></div>
              <div class="course-content">
                <span class="course-category">Mobile</span>
                <h3 class="course-title">Curso em Desenvolvimento</h3>
                <p class="course-description">
                  Este espaço está reservado para um novo curso que será lançado em breve. Fique atento às novidades!
                </p>
                <div class="course-meta">
                  <div class="course-instructor">
                    <div class="instructor-avatar">?</div>
                    <span>Instrutor em breve</span>
                  </div>
                  <div class="course-rating">
                    <i class="fas fa-star"></i>
                    <span>--</span>
                  </div>
                </div>
                <div class="course-price">Em breve</div>
              </div>
            </div>

            <!-- Curso Placeholder 5 -->
            <div class="course-card placeholder">
              <div class="course-image"></div>
              <div class="course-content">
                <span class="course-category">DevOps</span>
                <h3 class="course-title">Curso em Desenvolvimento</h3>
                <p class="course-description">
                  Este espaço está reservado para um novo curso que será lançado em breve. Fique atento às novidades!
                </p>
                <div class="course-meta">
                  <div class="course-instructor">
                    <div class="instructor-avatar">?</div>
                    <span>Instrutor em breve</span>
                  </div>
                  <div class="course-rating">
                    <i class="fas fa-star"></i>
                    <span>--</span>
                  </div>
                </div>
                <div class="course-price">Em breve</div>
              </div>
            </div>

            <!-- Curso Placeholder 6 -->
            <div class="course-card placeholder">
              <div class="course-image"></div>
              <div class="course-content">
                <span class="course-category">IA & Machine Learning</span>
                <h3 class="course-title">Curso em Desenvolvimento</h3>
                <p class="course-description">
                  Este espaço está reservado para um novo curso que será lançado em breve. Fique atento às novidades!
                </p>
                <div class="course-meta">
                  <div class="course-instructor">
                    <div class="instructor-avatar">?</div>
                    <span>Instrutor em breve</span>
                  </div>
                  <div class="course-rating">
                    <i class="fas fa-star"></i>
                    <span>--</span>
                  </div>
                </div>
                <div class="course-price">Em breve</div>
              </div>
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
    const menuBtn = document.getElementById('menu-btn');
    
    if (menuBtn) {
      menuBtn.addEventListener('click', () => {
        // Aqui você pode adicionar funcionalidade para o menu dropdown
        console.log('Menu clicado');
      });
    }

    /* ===== BARRA DE PESQUISA ===== */
    const searchInput = document.getElementById('search-input');
    const searchForm = document.querySelector('.search-form');
    
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const searchTerm = searchInput.value.trim();
      if (searchTerm) {
        console.log('Pesquisando por:', searchTerm);
        // Aqui você pode adicionar a lógica de pesquisa
      }
    });

    /* ===== CAROUSEL ===== */
    const slides = document.querySelectorAll('.carousel-slide');
    const btnPrev = document.querySelector('.arrow.left');
    const btnNext = document.querySelector('.arrow.right');
    let current = 0;
    let timer;

    function showSlide(i) {
      slides.forEach((s, idx) => {
        s.classList.toggle('active', idx === i);
      });
    }

    function next() {
      current = (current + 1) % slides.length;
      showSlide(current);
    }

    function prev() {
      current = (current - 1 + slides.length) % slides.length;
      showSlide(current);
    }

    btnNext.addEventListener('click', () => {
      next();
      resetTimer();
    });

    btnPrev.addEventListener('click', () => {
      prev();
      resetTimer();
    });

    function startTimer() {
      timer = setInterval(next, 5000);
    }

    function resetTimer() {
      clearInterval(timer);
      startTimer();
    }

    showSlide(current);
    startTimer();

    /* ===== BOTÃO TOPO VISIBILIDADE ===== */
    const btnTopo = document.getElementById('btn-topo');
    
    window.addEventListener('scroll', () => {
      btnTopo.classList.toggle('show', window.scrollY > 300);
    });

    /* ===== ANIMAÇÃO DOS CARDS DE CURSO ===== */
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, index * 100);
        }
      });
    }, observerOptions);

    // Aplicar animação aos cards de curso
    document.querySelectorAll('.course-card').forEach((card, index) => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = 'all 0.6s ease';
      observer.observe(card);
    });
  </script>
</body>
</html>

