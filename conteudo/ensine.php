<?php 

include('conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("localhost", "root", "", "test");

    if ($mysqli->connect_errno) {
        $mensagem = "Erro de conexão: " . $mysqli->connect_error;
    } else {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $experiencia = $_POST['experiencia'] ?? '';
        $descricao = $_POST['descricao'] ?? '';

        // Inserir no banco
        $stmt = $mysqli->prepare("INSERT INTO candidaturas (nome, email, telefone, experiencia, descricao) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $email, $telefone, $experiencia, $descricao);

        if ($stmt->execute()) {
    echo "<script>
        alert('Candidatura enviada com sucesso! Nossa equipe entrará em contato em até 48 horas.');
        window.location.href = 'ensine.php'; </script>";
} else {
    echo "<script>
        alert('Erro ao enviar candidatura: " . $stmt->error . "');
    </script>";
}

        $stmt->close();
        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ensine na TechBridge - Compartilhe seu Conhecimento</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/ensine.css">
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
      <!-- ===== HERO SECTION ===== -->
      <section id="hero">
        <div class="hero-content">
          <div class="hero-text">
            <h1 class="hero-title">Ensine na TechBridge</h1>
            <p class="hero-subtitle">
              Compartilhe seu conhecimento e inspire milhares de estudantes ao redor do mundo. 
              Torne-se um instrutor e faça parte da maior plataforma de educação tecnológica do Brasil.
            </p>
            
            
          </div>
          <div class="hero-image">
            <div class="hero-illustration">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
          </div>
        </div>
      </section>
      <section id="cta">
        <div class="cta-content">
          <h2 class="cta-title">Pronto para começar sua jornada como instrutor?</h2>
          <p class="cta-subtitle">
            Junte-se a mais de 1.200 instrutores que já estão transformando vidas e construindo uma carreira de sucesso na TechBridge.
          </p>
          <div class="cta-buttons">
            <button class="btn-primary large" onclick="openInstructorForm()">
              <i class="fas fa-rocket"></i>
              Tornar-se Instrutor
            </button>
            
          </div>
        </div>
      </section>

    

      <!-- ===== CALL TO ACTION ===== -->
      
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
      <p>&copy; 2025 TechBridge. Todos os direitos reservados.</p>
    </div>
  </footer>

  
    </div>
  </div>

  <!-- Modal de Cadastro de Instrutor -->
  <div id="instructor-modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeInstructorForm()">&times;</span>
      <h2 class="modal-title">Torne-se um Instrutor</h2>
      <form method="POST" class="instructor-form">
        <div class="form-group">
          <label for="nome">Nome Completo</label>
          <input type="text" id="nome" name="nome" required>
        </div>
        
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" value="email" required >
        </div>
        
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="tel" id="telefone" name="telefone" required>
        </div>
        
        <div class="form-group">
          <label for="experiencia">Área de Experiência</label>
          <select id="experiencia" name="experiencia" required>
            <option value="">Selecione uma área</option>
            <option value="programacao">Programação</option>
            <option value="design">Design</option>
            <option value="data-science">Data Science</option>
            <option value="mobile">Desenvolvimento Mobile</option>
            <option value="devops">Cloud & DevOps</option>
            <option value="ia">Inteligência Artificial</option>
            <option value="outros">Outros</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="descricao">Conte-nos sobre sua experiência</label>
          <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva sua experiência profissional e o que você gostaria de ensinar..." required></textarea>
        </div>
        
        <button type="submit" class="btn-primary">
          <i class="fas fa-paper-plane"></i>
          Enviar Candidatura
        </button>
      </form>
    </div>
  </div>
  
  <!-- ===== SCRIPT ===== -->
  <script>
    /* ===== NAVEGAÇÃO SUAVE ===== */
    function scrollToSection(sectionId) {
      const section = document.getElementById(sectionId);
      if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
      }
    }

    /* ===== BARRA DE PESQUISA ===== */
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.getElementById('search-input');
    
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const searchTerm = searchInput.value.trim();
      if (searchTerm) {
        console.log('Pesquisando por:', searchTerm);
        // Aqui você pode adicionar a lógica de pesquisa
      }
    });

    /* ===== BOTÃO TOPO VISIBILIDADE ===== */
    const btnTopo = document.getElementById('btn-topo');
    
    window.addEventListener('scroll', () => {
      btnTopo.classList.toggle('show', window.scrollY > 300);
    });

    /* ===== MODAL DE INSTRUTOR ===== */
    function openInstructorForm() {
      document.getElementById('instructor-modal').style.display = 'block';
    }

    function closeInstructorForm() {
      document.getElementById('instructor-modal').style.display = 'none';
    }

    function submitInstructorForm(event) {
      event.preventDefault();
      
      // Mostrar mensagem de sucesso
      alert('Candidatura enviada com sucesso! Nossa equipe entrará em contato em até 48 horas.');
      
      // Fechar modal e limpar formulário
      closeInstructorForm();
      event.target.reset();
    }

    // Fechar modal ao clicar fora dele
    window.addEventListener('click', (event) => {
      const modal = document.getElementById('instructor-modal');
      if (event.target === modal) {
        closeInstructorForm();
      }
    });

    /* ===== ANIMAÇÕES DE ENTRADA ===== */
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

    // Aplicar animação aos elementos
    document.querySelectorAll('.benefit-card, .step-item, .category-card, .testimonial-card').forEach((element, index) => {
      element.style.opacity = '0';
      element.style.transform = 'translateY(30px)';
      element.style.transition = 'all 0.6s ease';
      observer.observe(element);
    });

    /* ===== CONTADOR ANIMADO ===== */
    function animateCounter(element, target) {
      let current = 0;
      const increment = target / 100;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        
        if (target >= 1000) {
          element.textContent = (current / 1000).toFixed(1) + 'K+';
        } else {
          element.textContent = Math.floor(current) + '%';
        }
      }, 20);
    }

    // Animar contadores quando visíveis
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const statNumbers = entry.target.querySelectorAll('.stat-number');
          statNumbers.forEach(stat => {
            const text = stat.textContent;
            if (text.includes('50K+')) {
              animateCounter(stat, 50000);
            } else if (text.includes('1.2K+')) {
              animateCounter(stat, 1200);
            } else if (text.includes('95%')) {
              animateCounter(stat, 95);
            }
          });
          statsObserver.unobserve(entry.target);
        }
      });
    });

    const heroStats = document.querySelector('.hero-stats');
    if (heroStats) {
      statsObserver.observe(heroStats);
    }
  </script>
</body>
</html>

