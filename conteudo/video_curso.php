<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Programação em Python do básico ao avançado - TechBridge</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/video_curso.css">
</head>
<body>
  <!-- ===== HEADER ===== -->
  <header class="course-header">
    <div class="header-content">
      <div class="header-left">
        <a href="home.php" class="logo">
          <img src="images/image-removebg-preview.png" alt="TechBridge Logo" class="logo-img">
        </a>
        <div class="course-info">
          <h1 class="course-title">Programação em Python do básico ao avançado</h1>
        </div>
      </div>
      
      <div class="header-right">
        <div class="progress-info">
          <span class="progress-text">Seu progresso</span>
          <div class="progress-circle">
            <svg class="progress-ring" width="40" height="40">
              <circle class="progress-ring-circle" stroke="#fff" stroke-width="3" fill="transparent" r="16" cx="20" cy="20" style="stroke-dasharray: 100.53; stroke-dashoffset: 75.4;"/>
            </svg>
            <span class="progress-percentage">25%</span>
          </div>
        </div>
        
        <button class="share-btn">
          <i class="fas fa-share"></i>
          Compartilhar
        </button>
        
        <button class="menu-btn">
          <i class="fas fa-ellipsis-v"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="main-content">
    <!-- Video Player Section -->
    <div class="video-section">
      <div class="video-container">
        <video class="video-player" controls poster="images/logica-de-programacao-na-pratica.jpg">
          <source src="#" type="video/mp4">
          Seu navegador não suporta o elemento de vídeo.
        </video>
        
        <!-- Video Controls Overlay -->
        <div class="video-controls-overlay">
          <div class="video-progress">
            <div class="progress-bar">
              <div class="progress-fill" style="width: 25%;"></div>
            </div>
          </div>
          
          <div class="video-controls">
            <div class="controls-left">
              <button class="control-btn play-pause">
                <i class="fas fa-play"></i>
              </button>
              <button class="control-btn">
                <i class="fas fa-undo"></i>
              </button>
              <span class="time-display">0:00 / 0:00</span>
            </div>
            
            <div class="controls-center">
              <span class="playback-speed">1x</span>
            </div>
            
            <div class="controls-right">
              <button class="control-btn">
                <i class="fas fa-volume-up"></i>
              </button>
              <button class="control-btn">
                <i class="fas fa-cog"></i>
              </button>
              <button class="control-btn">
                <i class="fas fa-expand"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Course Navigation -->
      <div class="course-navigation">
        <button class="nav-btn prev-btn">
          <i class="fas fa-chevron-left"></i>
          Anterior
        </button>
        <button class="nav-btn next-btn">
          Próximo
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
      
      <!-- Course Tabs -->
      <div class="course-tabs">
        <div class="tabs-nav">
          <button class="tab-btn active" data-tab="overview">
            <i class="fas fa-search"></i>
            Visão geral
          </button>
          <button class="tab-btn" data-tab="qa">
            <i class="fas fa-question-circle"></i>
            Perguntas e respostas
          </button>
          <button class="tab-btn" data-tab="notes">
            <i class="fas fa-sticky-note"></i>
            Observações
          </button>
          <button class="tab-btn" data-tab="announcements">
            <i class="fas fa-bullhorn"></i>
            Anúncios
          </button>
          <button class="tab-btn" data-tab="reviews">
            <i class="fas fa-star"></i>
            Avaliações
          </button>
          <button class="tab-btn" data-tab="tools">
            <i class="fas fa-tools"></i>
            Ferramentas de aprendizado
          </button>
        </div>
        
        <div class="tab-content">
          <div class="tab-panel active" id="overview">
            <h3>Aprenda Python com Expressões Lambdas, Iteradores, Geradores, Orientação a Objetos e muito mais!</h3>
            <div class="course-stats">
              <div class="stat">
                <span class="stat-value">4,6</span>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
              </div>
              <div class="stat">
                <span class="stat-value">109.845</span>
                <span class="stat-label">Alunos</span>
              </div>
              <div class="stat">
                <span class="stat-value">64 horas</span>
                <span class="stat-label">Total</span>
              </div>
            </div>
            
            <div class="course-description">
              <p>Este curso abrangente de Python foi projetado para levar você do básico ao avançado, cobrindo todos os aspectos essenciais da linguagem de programação mais popular do mundo.</p>
              <p>Você aprenderá desde conceitos fundamentais como variáveis e estruturas de controle até tópicos avançados como programação orientada a objetos, expressões lambda, iteradores e geradores.</p>
            </div>
          </div>
          
          <div class="tab-panel" id="qa">
            <div class="qa-section">
              <h3>Perguntas e Respostas</h3>
              <p>Faça perguntas e obtenha respostas da comunidade de estudantes e instrutores.</p>
              <button class="ask-question-btn">Fazer uma pergunta</button>
            </div>
          </div>
          
          <div class="tab-panel" id="notes">
            <div class="notes-section">
              <h3>Suas Observações</h3>
              <p>Adicione observações pessoais sobre as aulas para revisar mais tarde.</p>
              <button class="add-note-btn">Adicionar observação</button>
            </div>
          </div>
          
          <div class="tab-panel" id="announcements">
            <div class="announcements-section">
              <h3>Anúncios do Curso</h3>
              <p>Fique por dentro das últimas atualizações e novidades do curso.</p>
            </div>
          </div>
          
          <div class="tab-panel" id="reviews">
            <div class="reviews-section">
              <h3>Avaliações dos Estudantes</h3>
              <p>Veja o que outros estudantes estão dizendo sobre este curso.</p>
            </div>
          </div>
          
          <div class="tab-panel" id="tools">
            <div class="tools-section">
              <h3>Ferramentas de Aprendizado</h3>
              <p>Recursos adicionais para melhorar sua experiência de aprendizado.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Course Content Sidebar -->
    <aside class="course-sidebar">
      <div class="sidebar-header">
        <h2>Conteúdo do curso</h2>
        <button class="ai-assistant-btn">
          <i class="fas fa-robot"></i>
          AI Assistant
        </button>
      </div>
      
      <div class="course-content">
        <!-- Section 1 -->
        <div class="content-section">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="section-info">
              <h3>1. Sobre o curso</h3>
              <span class="section-duration">7m</span>
            </div>
            <button class="resources-btn">
              <i class="fas fa-download"></i>
              Recursos
            </button>
          </div>
          
          <div class="section-content">
            <div class="lesson-item current">
              <div class="lesson-checkbox">
                <i class="fas fa-check"></i>
              </div>
              <div class="lesson-info">
                <span class="lesson-title">1. Sobre o curso</span>
                <span class="lesson-duration">7m</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Section 2 -->
        <div class="content-section">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-right"></i>
            </button>
            <div class="section-info">
              <h3>2. Informações Importantes</h3>
              <span class="section-duration">2m</span>
            </div>
          </div>
        </div>
        
        <!-- Section 3 -->
        <div class="content-section">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-right"></i>
            </button>
            <div class="section-info">
              <h3>3. Preparação do ambiente</h3>
              <span class="section-duration">1m</span>
            </div>
          </div>
        </div>
        
        <!-- Section 4 -->
        <div class="content-section">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-right"></i>
            </button>
            <div class="section-info">
              <h3>4. Testando o ambiente preparado</h3>
              <span class="section-duration">8m</span>
            </div>
          </div>
        </div>
        
        <!-- Section 5 -->
        <div class="content-section expanded">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="section-info">
              <h3>Seção 2: Introdução à linguagem Python</h3>
              <span class="section-progress">2 / 5 | 1h 41m</span>
            </div>
          </div>
        </div>
        
        <!-- Section 6 -->
        <div class="content-section expanded">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="section-info">
              <h3>Seção 3: Variáveis e Tipos de Dados em Python</h3>
              <span class="section-progress">0 / 8 | 1h 46m</span>
            </div>
          </div>
        </div>
        
        <!-- Section 7 -->
        <div class="content-section expanded">
          <div class="section-header">
            <button class="section-toggle">
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="section-info">
              <h3>Seção 4: Estruturas Lógicas e Condicionais em Python</h3>
              <span class="section-progress">0 / 5 | 57m</span>
            </div>
          </div>
        </div>
      </div>
    </aside>
  </main>

  <!-- ===== SCRIPT ===== -->
  <script>
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetTab = btn.getAttribute('data-tab');
        
        // Remove active class from all tabs and panels
        tabBtns.forEach(b => b.classList.remove('active'));
        tabPanels.forEach(p => p.classList.remove('active'));
        
        // Add active class to clicked tab and corresponding panel
        btn.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
      });
    });
    
    // Section toggle functionality
    const sectionToggles = document.querySelectorAll('.section-toggle');
    
    sectionToggles.forEach(toggle => {
      toggle.addEventListener('click', () => {
        const section = toggle.closest('.content-section');
        const icon = toggle.querySelector('i');
        
        section.classList.toggle('expanded');
        
        if (section.classList.contains('expanded')) {
          icon.className = 'fas fa-chevron-down';
        } else {
          icon.className = 'fas fa-chevron-right';
        }
      });
    });
    
    // Video controls
    const playPauseBtn = document.querySelector('.play-pause');
    const video = document.querySelector('.video-player');
    
    playPauseBtn.addEventListener('click', () => {
      const icon = playPauseBtn.querySelector('i');
      
      if (video.paused) {
        video.play();
        icon.className = 'fas fa-pause';
      } else {
        video.pause();
        icon.className = 'fas fa-play';
      }
    });
  </script>
</body>
</html>

