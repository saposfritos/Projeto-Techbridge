<?php
include('conexao.php');

if (!isset($_SESSION)) session_start();

if (isset($_POST['confirmar'])) {
    $erro = [];

    foreach ($_POST as $chave => $valor) {
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    }

    // Validações
    if (empty($_SESSION['nome']))
        $erro[] = "Preencha o nome.";

    if (empty($_SESSION['sobrenome']))
        $erro[] = "Preencha o sobrenome.";

    if (!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL))
        $erro[] = "Preencha o email corretamente.";

    if (!isset($_SESSION['sexo']) || !is_numeric($_SESSION['sexo']))
        $erro[] = "Selecione o sexo.";

    if (strlen($_SESSION['senha']) < 8 || strlen($_SESSION['senha']) > 16)
        $erro[] = "A senha deve conter entre 8 e 16 caracteres.";

    if ($_SESSION['senha'] !== $_SESSION['rsenha'])
        $erro[] = "As senhas não conferem.";

    if (empty($_SESSION['telefone']))
        $erro[] = "Preencha o telefone.";

    if (empty($_SESSION['data_nasc']))
        $erro[] = "Preencha a data de nascimento.";

    if (count($erro) == 0) {
        $senha_hash = password_verify($_SESSION['senha'], PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO usuario (nome, sobrenome, email, senha, sexo, telefone, data_nasc) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssss",
            $_SESSION['nome'],
            $_SESSION['sobrenome'],
            $_SESSION['email'],
            $_SESSION['senha'],
            $_SESSION['sexo'],
            $_SESSION['telefone'],
            $_SESSION['data_nasc']
        );

        if ($stmt->execute()) {
            unset(
                $_SESSION['nome'],
                $_SESSION['sobrenome'],
                $_SESSION['email'],
                $_SESSION['senha'],
                $_SESSION['rsenha'],
                $_SESSION['sexo'],
                $_SESSION['telefone'],
                $_SESSION['data_nasc']
            );

            echo "<script>location.href='Login.php';</script>";
            exit;
        } else {
            $erro[] = "Erro ao salvar no banco de dados.";
        }
    }

    if (!empty($erro)) {
        foreach ($erro as $e) {
            echo "<p style='color: red;'>$e</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro - Meu Curso Online</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/cadastro.css">
</head>
<body>
  <div class="signup-container">
    <div class="form-side">
      <div class="form-header">
        <h2 class="form-title">Crie sua conta</h2>
        <p class="form-subtitle">Junte-se a milhares de estudantes e comece sua jornada</p>
      </div>


      <h1> Cadastrar Usuario </h1>
<form action="cadastro.php" method="POST" class="signup-form" id="signupForm">
        <div class="form-row">
          <div class="input-group">
            <label for="firstName">Nome</label>
            <div class="input-wrapper">
              <i class="fas fa-user"></i>
              <input 
                id="nome"  
                type="text"
                id="nome" 
                name="nome" 
                class="form-input" 
                placeholder="Seu nome"
                required
              >
            </div>
          </div>

          <div class="input-group">
            <label for="lastName">Sobrenome</label>
            <div class="input-wrapper">
              <i class="fas fa-user"></i>
              <input 
                type="text" 
                id="sobrenome" 
                name="sobrenome" 
                class="form-input" 
                placeholder="Seu sobrenome"
                required
              >
            </div>
          </div>
        </div>

        <div class="input-group full-width">
          <label for="email">E-mail</label>
          <div class="input-wrapper">
            <i class="fas fa-envelope"></i>
            <input 
              type="email" 
              id="email" 
              name="email" 
              class="form-input" 
              placeholder="Digite seu e-mail"
              required
            >
          </div>
        </div>

        <div class="form-row">
          <div class="input-group">
            <label for="phone">Telefone</label>
            <div class="input-wrapper">
              <i class="fas fa-phone"></i>
              <input 
                type="text" 
                id="telefone" 
                name="telefone" 
                class="form-input" 
                placeholder="(11) 12346-7890"
                required
              >
            </div>
          </div>

          <div class="input-group">
            <label for="birthDate">Data de Nascimento</label>
            <div class="input-wrapper">
              <i class="fas fa-calendar"></i>
              <input 
                type="date" 
                id="data_nasc" 
                name="data_nasc" 
                class="form-input"
                required
              >
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="input-group">
            <label for="password">Senha</label>
            <div class="input-wrapper">
              <i class="fas fa-lock"></i>
              <input 
                type="password" 
                id="senha" 
                name="senha" 
                class="form-input" 
                placeholder="Crie uma senha forte"
                required
              >
            </div>
            <div class="password-strength" id="passwordStrength">
              <div class="password-strength-bar"></div>
            </div>
            
          </div>

          <div class="input-group">
            <label for="rsenha">Confirmar Senha</label>
            <div class="input-wrapper">
              <i class="fas fa-lock"></i>
              <input 
                type="password" 
                id="rsenha" 
                name="rsenha" 
                class="form-input" 
                placeholder="Confirme sua senha"
                required
              >
            </div>
          </div>
        </div>

        <div class="input-group full-width">
          <label>Gênero</label>
          <div class="gender-options">
            <div class="gender-option">
              <input type="radio" id="male" name="sexo" value="1">
              <label for="male">Masculino</label>
            </div>
            <div class="gender-option">
              <input type="radio" id="female" name="sexo" value="2">
              <label for="female">Feminino</label>
            </div>
            <div class="gender-option">
              <input type="radio" id="other" name="sexo" value="3">
              <label for="other">Outros</label>
            </div>
          </div>
        </div>


        <button type="submit" name="confirmar" class="signup-button" id="submitBtn">
          Criar Conta
        </button>
      </form>

      

      <div class="login-link">
        Já tem uma conta? <a href="login.php">Faça login aqui</a>
      </div>
    </div>

    <!-- Lado Direito - Branding -->
    <div class="branding-side">
      <div class="logo-section">
        <div class="logo-icon">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <h1 class="brand-title">TechBridge</h1>
        <p class="brand-subtitle">Transforme seu futuro com educação de qualidade</p>
        
      
        </ul>
      </div>
    </div>
  </div>

  <script>
    // Máscara para telefone
    document.getElementById('phone').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length >= 11) {
        value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
      } else if (value.length >= 7) {
        value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
      } else if (value.length >= 3) {
        value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
      }
      e.target.value = value;
    });

    // Verificador de força da senha
    document.getElementById('senha').addEventListener('input', function(e) {
      const password = e.target.value;
      const strengthIndicator = document.getElementById('passwordStrength');
      const hint = document.getElementById('passwordHint');
      
      if (password.length > 0) {
        strengthIndicator.classList.add('show');
        hint.classList.add('show');
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        strengthIndicator.className = 'password-strength show';
        if (strength <= 2) {
          strengthIndicator.classList.add('weak');
        } else if (strength <= 4) {
          strengthIndicator.classList.add('medium');
        } else {
          strengthIndicator.classList.add('strong');
        }
      } else {
        strengthIndicator.classList.remove('show');
        hint.classList.remove('show');
      }
    });

    // Validação do formulário
    document.getElementById('signupForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const data = Object.fromEntries(formData);
      
      // Validações
      if (!data.nome || !data.sobrenome) {
        alert('Por favor, preencha seu nome completo.');
        return;
      }
      
      if (!isValidEmail(data.email)) {
        alert('Por favor, digite um e-mail válido.');
        return;
      }
      
      if (!data.telefone || data.telefone.length < 14) {
        alert('Por favor, digite um telefone válido.');
        return;
      }
      
      if (!data.data_nasc) {
        alert('Por favor, informe sua data de nascimento.');
        return;
      }
      
      if (data.senha.length < 8) {
        alert('A senha deve ter pelo menos 8 caracteres.');
        return;
      }
      
      if (data.senha !== data.rsenha) {
        alert('As senhas não coincidem.');
        return;
      }
      
      if (!data.sexo) {
        alert('Por favor, selecione seu gênero.');
        return;
      }
      
      if (!data.terms) {
        alert('Você deve aceitar os termos de uso.');
        return;
      }
      
      // Simulação de cadastro
      const button = document.getElementById('submitBtn');
      const originalText = button.textContent;
      
      button.textContent = 'Criando conta...';
      button.disabled = true;
      
      setTimeout(() => {
        alert('Conta criada com sucesso! Redirecionando para o login...');
        button.textContent = originalText;
        button.disabled = false;
        
        // Simular redirecionamento
        setTimeout(() => {
          window.location.href = 'login.php';
        }, 1000);
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

    // Validação em tempo real da confirmação de senha
    document.getElementById('rsenha').addEventListener('input', function(e) {
      const senha = document.getElementById('senha').value;
      const rsenha = e.target.value;
      
      if (rsenha && password !== rsenha) {
        e.target.style.borderColor = '#ff4444';
      } else {
        e.target.style.borderColor = '#e0e0e0';
      }
    });
  </script>
</body>
</html>
