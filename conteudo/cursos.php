<?php 

include('conexao.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />

  <title>Visualizar Cursos - TechBridge</title>
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
      <section id="view-courses">
        <div class="section-header">
          <h2 class="section-title">Cursos Disponíveis</h2>
          <p class="section-subtitle">
            Explore nossa coleção de cursos de tecnologia e encontre o conhecimento que você precisa.
          </p>
        </div>
        
        <!-- Filtros -->
        <div class="filters-container">
          <div class="filter-group">
            <label for="category-filter">Filtrar por categoria:</label>
            <select id="category-filter" onchange="filterCourses()">
              <option value="">Todas as categorias</option>
              <option value="programacao">Programação</option>
              <option value="design">Design</option>
              <option value="data-science">Data Science</option>
              <option value="mobile">Desenvolvimento Mobile</option>
              <option value="devops">Cloud & DevOps</option>
              <option value="ia">Inteligência Artificial</option>
              <option value="outros">Outros</option>
            </select>
          </div>
          <div class="search-filter">
            <input type="text" id="search-filter" placeholder="Pesquisar cursos..." onkeyup="searchCourses()">
          </div>
        </div>

        <!-- Grid de Cursos -->
        <div class="courses-grid" id="courses-grid">
          <!-- Os cursos serão inseridos aqui via JavaScript -->
        </div>

        <!-- Mensagem quando não há cursos -->
        <div class="no-courses" id="no-courses" style="display: none;">
          <div class="no-courses-icon">
            <i class="fas fa-search"></i>
          </div>
          <h3>Nenhum curso encontrado</h3>
          <p>Tente ajustar os filtros ou pesquisar por outros termos.</p>
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

    <script>
  document.addEventListener('DOMContentLoaded', () => {
    fetch('curso_connect.php')
      .then(response => response.json())
      .then(courses => {
        renderCourses(courses); 
      })
      .catch(error => {
        console.error('Erro ao buscar cursos:', error);
        renderCourses([]); 
      });
  });
</script>
    

  <!-- ===== SCRIPT ===== -->
  <script>
    /* ===== DADOS DOS CURSOS (SIMULADOS) ===== */
    const coursesDatsa = [
      {
        id: 1,
        title: "Node.js e Express",
        description: "Backend development com Node.js, Express, MongoDB e APIs RESTful.",
        category: "programacao",
        image: "https://via.placeholder.com/300x200/339933/ffffff?text=Node.js",
        instructor: "Lucas Mendes",
      }
    ];

    let filteredCourses = [...coursesData];

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

    /* ===== RENDERIZAÇÃO DOS CURSOS ===== */
    function renderCourses(courses) {
      const coursesGrid = document.getElementById('courses-grid');
      const noCourses = document.getElementById('no-courses');
      
      if (courses.length === 0) {
        coursesGrid.innerHTML = '';
        noCourses.style.display = 'block';
        return;
      }
      
      noCourses.style.display = 'none';
      
      coursesGrid.innerHTML = courses.map(course => `
        <div class="course-card" data-category="${course.category}">
          <div class="course-image">
            <img src="${course.image}" alt="${course.title}" onerror="this.src='https://via.placeholder.com/300x200/6200ea/ffffff?text=Curso'">

          </div>
          <div class="course-content">
            <h3 class="course-title">${course.title}</h3>
            <p class="course-description">${course.description}</p>
            <div class="course-meta">
              <div class="course-instructor">
                <i class="fas fa-user"></i>
                ${course.instructor}
              </div>
            </div>
            <div class="course-actions">
              <button class="btn-primary" onclick="enrollCourse(${course.id})">
                <i class="fas fa-play"></i>
                Inscrever-se
              </button>
              <button class="btn-secondary" onclick="viewCourse(${course.id})">
                <i class="fas fa-eye"></i>
                Ver Detalhes
              </button>
            </div>
          </div>
        </div>
      `).join('');
    }

    /* ===== FILTROS ===== */
    function filterCourses() {
      const categoryFilter = document.getElementById('category-filter').value;
      const searchFilter = document.getElementById('search-filter').value.toLowerCase();
      
      filteredCourses = coursesData.filter(course => {
        const matchesCategory = !categoryFilter || course.category === categoryFilter;
        const matchesSearch = !searchFilter || 
          course.title.toLowerCase().includes(searchFilter) ||
          course.description.toLowerCase().includes(searchFilter) ||
          course.instructor.toLowerCase().includes(searchFilter);
        
        return matchesCategory && matchesSearch;
      });
      
      renderCourses(filteredCourses);
    }

    function searchCourses() {
      filterCourses();
    }

    /* ===== AÇÕES DOS CURSOS ===== */
    function enrollCourse(courseId) {
      const course = coursesData.find(c => c.id === courseId);
      alert(`Inscrição realizada com sucesso no curso: ${course.title}`);
    }

    function viewCourse(courseId) {
      const course = coursesData.find(c => c.id === courseId);
      alert(`Visualizando detalhes do curso: ${course.title}`);
    }

    /* ===== INICIALIZAÇÃO ===== */
    document.addEventListener('DOMContentLoaded', () => {
      renderCourses(coursesData);
    });
  </script>
</body>
</html>

