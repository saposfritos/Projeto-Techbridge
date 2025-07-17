<?php
include('conexao.php');
session_start();

$usuario = [
    'nome' => '',
    'sobrenome' => '',
    'sexo' => '',
    'email' => '',
    'data_nasc' => '',
    'telefone' => ''
];

if (isset($_SESSION['usuario'])) {
    $id = $_SESSION['usuario'];

    $stmt = $mysqli->prepare("SELECT nome, sobrenome, sexo, email, data_nasc, telefone FROM usuario WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu Perfil - TechBridge</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/index_logado.css">
  <link rel="stylesheet" href="style/perfil.css">
</head>
<body>
  <!-- Âncora topo -->
  <div id="topo"></div>

  <!-- ===== HEADER ===== -->
  <header class="topo" id="header">
    <nav class="navbar">
      <div class="logo-section">
        <a href="home_logado.php">
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
    <?php if (isset($_SESSION['usuario'])): ?>
      <!-- logadooo -->
      <div class="nav-links">
        <a href="ensine.php" class="teach-link">Ensine na TechBridge</a>
        <a href="meus_cursos.php" class="my-courses-link">Meus Cursos</a>
        </nav>
        </header>
      </div>
 <?php else: ?>
  <!-- nn logado -->
      <div class="nav-links">
        <div class="auth-buttons">
          <a href="login.php" class="login-btn">Null</a>
          <a href="cadastro.php" class="signup-btn">Null</a>
        </div>
      </div>
    </nav>
  </header>
  <?php endif; ?>

  <!-- ===== MAIN ===== -->
  <main>
    <div class="content-wrapper">
      <!-- ===== PERFIL DO USUÁRIO ===== -->
      <section id="perfil">
        <div class="profile-container">
          <!-- Cabeçalho do Perfil -->
          <div class="profile-header">
            <div class="profile-avatar">
              <i class="fas fa-user-circle"></i>
            </div>
            <?php if (isset($_SESSION['usuario'])): ?>
              <div class="profile-info">
              <h1 class="profile-name"><?= htmlspecialchars($usuario['nome'] . ' ' . $usuario['sobrenome']) ?></h1>
              <p class="profile-email"><?= htmlspecialchars($usuario['email']) ?></p>
              <p class="profile-member-since"><?php
            if ($usuario['sexo'] == 1) {
                echo "Masculino";
            } elseif ($usuario['sexo'] == 2) {
                echo "Feminino";
            } else {
                echo "Outro/Não informado";
            }
            ?></p>
            </div>
            <div class="profile-actions">
            <form action="logout.php" method="post">
              <button type="submit" class="logout-btn">
          </form>
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
              </button>
            </div>
          </div>
            <?php else: ?>
              <div class="profile-info">
              <h1 class="profile-name">Null</h1>
              <p class="profile-email">Null</p>
              <p class="profile-member-since">Membro desde: Null</p>
            </div>
            <div class="profile-actions">
              <button href= "#" class="logout-btn" onclick="#">
                <i class="fas fa-sign-out-alt"></i>
                <span>Null</span>
              </button>
            </div>
          </div>
            <?php endif; ?>
            

          <!-- Estatísticas do Usuário -->
          <?php if (isset($_SESSION['usuario'])): ?>
          <div class="profile-stats">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-book"></i>
              </div>
              <div class="stat-info">
                <h3>5</h3>
                <p>Cursos Concluídos</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stat-info">
                <h3>120h</h3>
                <p>Horas de Estudo</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-certificate"></i>
              </div>
              <div class="stat-info">
                <h3>3</h3>
                <p>Certificados</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-star"></i>
              </div>
              <div class="stat-info">
                <h3>4.8</h3>
                <p>Avaliação Média</p>
              </div>
            </div>
          </div>
          <?php else: ?>
            <div class="profile-stats">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-book"></i>
              </div>
              <div class="stat-info">
                <h3>#</h3>
                <p>Null</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stat-info">
                <h3>#</h3>
                <p>Null</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-certificate"></i>
              </div>
              <div class="stat-info">
                <h3>#</h3>
                <p>Null</p>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-star"></i>
              </div>
              <div class="stat-info">
                <h3>#</h3>
                <p>Null</p>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- Informações Pessoais -->
          <?php if (isset($_SESSION['usuario'])): ?>
          <div class="profile-section-content">
            <h2 class="section-title">
              <i class="fas fa-user"></i>
              Informações Pessoais
            </h2>
            <div class="info-grid">
              <div class="info-item">
                <label>Nome Completo</label>
                <div class="info-value">
                  <span>
                  <?= htmlspecialchars($usuario['nome'] . ' ' . $usuario['sobrenome']) ?>
            </span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Email</label>
                <div class="info-value">
                  <span><?= htmlspecialchars($usuario['email']) ?></span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Telefone</label>
                <div class="info-value">
                  <span><?= htmlspecialchars($usuario['telefone']) ?></span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Data de Nascimento</label>
                <div class="info-value">
                  <span><?= date("d/m/Y", strtotime($usuario['data_nasc'])) ?></span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Profissão</label>
                <div class="info-value">
                  <span>Desenvolvedor Full Stack</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Localização</label>
                <div class="info-value">
                  <span>Guarulhos, SP - Brasil</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <?php else: ?>
            <div class="profile-section-content">
            <h2 class="section-title">
              <i class="fas fa-user"></i>
              Informações Pessoais
            </h2>
            <div class="info-grid">
              <div class="info-item">
                <label>Null</label>
                <div class="info-value">
                  <span>#</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Null</label>
                <div class="info-value">
                  <span>#</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Null</label>
                <div class="info-value">
                  <span>#</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Null</label>
                <div class="info-value">
                  <span>#</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Null</label>
                <div class="info-value">
                  <span>#</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
              <div class="info-item">
                <label>Null</label>
                <div class="info-value">
                  <span>#</span>
                  <button class="edit-btn" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- Cursos em Andamento -->
          <div class="profile-section-content">
            <h2 class="section-title">
              <i class="fas fa-play-circle"></i>
              Cursos em Andamento
            </h2>
            <div class="courses-progress">
              <div class="course-progress-item">
                <div class="course-info">
                  <h4>JavaScript Avançado</h4>
                  <p>Módulo 3 de 8 - Funções e Closures</p>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 37.5%"></div>
                </div>
                <span class="progress-text">37.5%</span>
              </div>
              <div class="course-progress-item">
                <div class="course-info">
                  <h4>React.js Completo</h4>
                  <p>Módulo 2 de 6 - Componentes e Props</p>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 33.3%"></div>
                </div>
                <span class="progress-text">33.3%</span>
              </div>
              <div class="course-progress-item">
                <div class="course-info">
                  <h4>Node.js e APIs</h4>
                  <p>Módulo 1 de 5 - Introdução ao Node.js</p>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 20%"></div>
                </div>
                <span class="progress-text">20%</span>
              </div>
            </div>
          </div>

          <!-- Certificados -->
          <div class="profile-section-content">
            <h2 class="section-title">
              <i class="fas fa-award"></i>
              Certificados Conquistados
            </h2>
            <div class="certificates-grid">
              <div class="certificate-item">
                <div class="certificate-icon">
                  <i class="fas fa-certificate"></i>
                </div>
                <div class="certificate-info">
                  <h4>HTML5 e CSS3 Fundamentals</h4>
                  <p>Concluído em: 15/12/2023</p>
                  <button class="download-btn">
                    <i class="fas fa-download"></i>
                    Baixar
                  </button>
                </div>
              </div>
              <div class="certificate-item">
                <div class="certificate-icon">
                  <i class="fas fa-certificate"></i>
                </div>
                <div class="certificate-info">
                  <h4>Python para Iniciantes</h4>
                  <p>Concluído em: 28/11/2023</p>
                  <button class="download-btn">
                    <i class="fas fa-download"></i>
                    Baixar
                  </button>
                </div>
              </div>
              <div class="certificate-item">
                <div class="certificate-icon">
                  <i class="fas fa-certificate"></i>
                </div>
                <div class="certificate-info">
                  <h4>Git e GitHub Essencial</h4>
                  <p>Concluído em: 10/10/2023</p>
                  <button class="download-btn">
                    <i class="fas fa-download"></i>
                    Baixar
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Configurações de Conta -->
          <div class="profile-section-content">
            <h2 class="section-title">
              <i class="fas fa-cog"></i>
              Configurações da Conta
            </h2>
            <div class="settings-grid">
              <div class="setting-item">
                <div class="setting-info">
                  <h4>Notificações por Email</h4>
                  <p>Receber atualizações sobre novos cursos e promoções</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" checked>
                  <span class="slider"></span>
                </label>
              </div>
              <div class="setting-item">
                <div class="setting-info">
                  <h4>Notificações Push</h4>
                  <p>Receber lembretes sobre aulas e prazos</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" checked>
                  <span class="slider"></span>
                </label>
              </div>
              <div class="setting-item">
                <div class="setting-info">
                  <h4>Perfil Público</h4>
                  <p>Permitir que outros usuários vejam seu progresso</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
              </div>
            </div>
            
            <div class="danger-zone">
              <h3>Zona de Perigo</h3>
              <p>Ações irreversíveis que afetam permanentemente sua conta.</p>
              <div class="danger-actions">
                <button class="danger-btn" onclick="changePassword()">
                  <i class="fas fa-key"></i>
                  Alterar Senha
                </button>
                <button class="danger-btn delete" onclick="deleteAccount()">
                  <i class="fas fa-trash"></i>
                  Excluir Conta
                </button>
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
      <p>&copy; 2025 TechBridge. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- ===== SCRIPT ===== -->
  <script>
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

    /* ===== BOTÃO TOPO VISIBILIDADE ===== */
    const btnTopo = document.getElementById('btn-topo');
    
    window.addEventListener('scroll', () => {
      btnTopo.classList.toggle('show', window.scrollY > 300);
    });

    /* ===== FUNÇÕES DO PERFIL ===== */
    function logout() {
      if (confirm('Tem certeza que deseja sair da sua conta?')) {
        // Aqui você implementaria a lógica de logout
        alert('Logout realizado com sucesso!');
        // Redirecionar para a página inicial
        window.location.href = 'home.php';
      }
    }

    function changePassword() {
      alert('Funcionalidade de alteração de senha será implementada em breve.');
    }

    function deleteAccount() {
      if (confirm('ATENÇÃO: Esta ação é irreversível! Tem certeza que deseja excluir sua conta permanentemente?')) {
        if (confirm('Digite "CONFIRMAR" para prosseguir com a exclusão da conta:')) {
          alert('Funcionalidade de exclusão de conta será implementada em breve.');
        }
      }
    }

    /* ===== ANIMAÇÃO DOS ELEMENTOS ===== */
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

    // Aplicar animação aos elementos do perfil
    document.querySelectorAll('.stat-card, .info-item, .course-progress-item, .certificate-item, .setting-item').forEach((element, index) => {
      element.style.opacity = '0';
      element.style.transform = 'translateY(30px)';
      element.style.transition = 'all 0.6s ease';
      observer.observe(element);
    });
  </script>
</body>
</html>

