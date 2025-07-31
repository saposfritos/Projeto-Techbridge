<?php
include('conexao.php');

if (!isset($_SESSION)) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $stmt = $mysqli->prepare("SELECT ID FROM usuario WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $usuario['ID'];
        $_SESSION['Acesso'] = $usuario['Acesso'];
        $_SESSION['nome'] = $usuario['nome'];

        echo "<script>alert('Login realizado com sucesso!'); location.href='home.php';</script>";
        exit;
    } else {
        echo "<script>alert('Email ou senha incorretos.');</script>";
    }
}
?>

<form method="POST" action="">
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - TechBridge</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/login.css">
</head>
<body>
<?php 
    if (!empty($erro)) {
        foreach ($erro as $msg) {
            echo "<p style='color:red;'>$msg</p>";
        }
    }
    ?>
  <div class="login-container">
    <!-- Lado Esquerdo - Branding -->
    <div class="branding-side">
      <div class="logo-section">
        <div class="logo-icon">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <h1 class="brand-title">TechBridge</h1>
        <p class="brand-subtitle">Conectando conhecimento e oportunidades através da educação digital</p>
      </div>
    </div>

    <!-- Lado Direito - Formulário -->
    <div class="form-side">
      <div class="form-header">
        <h2 class="form-title">Bem-vindo de volta!</h2>
        <p class="form-subtitle">Faça login para continuar sua jornada de aprendizado</p>
      </div>

      <form method="POST" action="" class="login-form" id="loginForm">
        <div class="input-group">
          <label for="email">E-mail</label>
          <div class="input-wrapper">
            <i class="fas fa-envelope"></i>
            <input 
              type="email" 
              value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" 
              name="email" 
              id="email" 
              class="form-input" 
              placeholder="Digite seu e-mail"
              required
            >
          </div>
        </div>

        <div class="input-group">
          <label for="senha">Senha</label>
          <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input 
              name="senha" 
              type="password"
              id="senha" 
              class="form-input" 
              placeholder="Digite sua senha"
              required
            >
          </div>
        </div>
        <br>

        <button type="submit" value="Entrar" class="login-button">
        
          Entrar
        </button>
      </form>
      
      <div class="signup-link">
        Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>
      </div>
    </div>
  </div>

  <script>
    // Validação do formulário
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const email = document.getElementById('email').value;
      const senha = document.getElementById('senha').value;
      
      if (!email || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
      }
      
      if (!isValidEmail(email)) {
        alert('Por favor, digite um e-mail válido.');
        return;
      }
      
      // Simulação de login
      const button = document.querySelector('.login-button');
      const originalText = button.textContent;
      
      button.textContent = 'Entrando...';
      button.disabled = true;
      
      setTimeout(() => {
        alert('Login realizado com sucesso!');
        button.textContent = originalText;
        button.disabled = false;
      }, 2000);
    });

    // Validação de e-mail
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    // Efeitos de foco nos inputs
    document.querySelectorAll('.form-input').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.parentElement.style.transform = 'scale(1.02)';
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.parentElement.style.transform = 'scale(1)';
      });
    });

    // Animação de carregamento nos botões sociais
    document.querySelectorAll('.social-button').forEach(button => {
      button.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Conectando...';
        this.disabled = true;
        
        setTimeout(() => {
          this.innerHTML = originalText;
          this.disabled = false;
          alert('Funcionalidade em desenvolvimento!');
        }, 2000);
      });
    });

    // Efeito de partículas no fundo (opcional)
    function createParticle() {
      const particle = document.createElement('div');
      particle.style.position = 'absolute';
      particle.style.width = '4px';
      particle.style.height = '4px';
      particle.style.background = 'rgba(255, 255, 255, 0.3)';
      particle.style.borderRadius = '50%';
      particle.style.pointerEvents = 'none';
      particle.style.left = Math.random() * 100 + '%';
      particle.style.top = '100%';
      particle.style.animation = 'particleFloat 8s linear infinite';
      
      document.querySelector('.branding-side').appendChild(particle);
      
      setTimeout(() => {
        particle.remove();
      }, 8000);
    }

    // Criar partículas periodicamente
    setInterval(createParticle, 2000);

    // CSS para animação das partículas
    const style = document.createElement('style');
    style.textContent = `
      @keyframes particleFloat {
        0% {
          transform: translateY(0) rotate(0deg);
          opacity: 0;
        }
        10% {
          opacity: 1;
        }
        90% {
          opacity: 1;
        }
        100% {
          transform: translateY(-100vh) rotate(360deg);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>

