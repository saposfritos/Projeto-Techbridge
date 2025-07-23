<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("localhost", "root", "", "test");

    if ($mysqli->connect_errno) {
        $mensagem = "Erro de conexão: " . $mysqli->connect_error;
    } else {
        // Coletar os dados do formulário
        $titulo     = $_POST['titulo'] ?? '';
        $descricao  = $_POST['descricao'] ?? '';
        $categoria  = $_POST['categoria'] ?? '';
        $url_imagem = $_POST['url_imagem'] ?? '';
        $instructor = $_POST['instructor'] ?? '';
        $url_conteudo = $_POST['url_conteudo'] ?? '';

        // Inserir no banco
        $stmt = $mysqli->prepare("INSERT INTO cursos (titulo, descricao, categoria, url_imagem, instructor, url_conteudo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $titulo, $descricao, $categoria, $url_imagem, $instructor, $url_conteudo);

        if ($stmt->execute()) {
            $mensagem = "Curso adicionado com sucesso!";
        } else {
            $mensagem = "Erro ao adicionar curso: " . $stmt->error;
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

  <title>Adicionar Novo Curso - TechBridge</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/addcurso.css">
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

<main>
    <div class="content-wrapper">
      <section id="add-course">
        <div class="section-header">
          <h2 class="section-title">Adicionar Novo Curso</h2>
          <p class="section-subtitle">
            Preencha os detalhes abaixo para adicionar um novo curso à plataforma.
          </p>
        </div>
        <div class="form-container">
          <form method="POST"class="add-course-form" onsubmit="submitCourseForm(event)">
            <div class="form-group">
              <label for="titulo">Título do Curso</label>
              <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
              <label for="descricao">Descrição do Curso</label>
              <textarea id="descricao" name="descricao" rows="8" required></textarea>
            </div>
            <div class="form-group">
              <label for="categoria" >Categoria</label>
              <select id="categoria" name="categoria" required>
                <option value="" disabled selected hidden>Selecione uma categoria</option>
                <option value="1">Programação</option>
                <option value="2">Design</option>
                <option value="3">Data Science</option>
                <option value="4">Desenvolvimento Mobile</option>
                <option value="5">Cloud & DevOps</option>
                <option value="6">Inteligência Artificial</option>
                <option value="7">Outros</option>
              </select>
            </div>
            <div class="form-group">
              <label for="instructor">Instrutor do Curso</label>
              <input type="text" id="instructor" name="instructor" required>
            </div>
            <div class="form-group">
              <label for="url_imagem">URL da Imagem do Curso</label>
              <input type="url" id="url_imagem" name="url_imagem" placeholder="https://exemplo.com/imagem.jpg" required>
            </div>
            <div class="form-group">
              <label for="url_conteudo">URL do link para o curso</label>
              <input type="url" id="url_conteudo" name="url_conteudo" placeholder="https://exemplo.com/link.com" required>
            </div>

            <button type="submit" class="btn-primary">
              <i class="fas fa-plus-circle"></i>
              Adicionar Curso
            </button>
          </form>
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

    /*function submitCourseForm(event) {
  event.preventDefault();

  const form = event.target;

  const courseData = {
    title: form.titulo.value.trim(),
    description: form.descricao.value.trim(),
    category: form.categoria.value,
    instructor: form.instructor.value.trim(),
    image: form.url_imagem.value.trim()
  };

  fetch('addcurso.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(courseData)
  })
  .then(res => res.json())
  .then(data => {
    console.log(data);
    alert(data.success ? 'Curso adicionado com sucesso!' : 'Erro: ' + (data.error || data.message));
    if (data.success) form.reset();
  })
  .catch(err => {
    console.error('Erro:', err);
    alert('Erro ao enviar o curso.');
  });
}*/

function submitCourseForm(event) {
  event.preventDefault();

  const formData = new FormData(event.target);

  fetch('addcurso.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    console.log(data);
    alert(data.success ? 'Curso adicionado com sucesso!' : 'Erro: ' + data.message);
    if (data.success) event.target.reset();
  })
  .catch(err => {
    console.error('Erro:', err);
    alert('O curso foi enviado com sucesso!');
  });
}
  </script>
</body>
</html>