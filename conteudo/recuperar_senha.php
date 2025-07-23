<?php 
session_start();

include('conexao.php');

$erro = [];

if (isset($_POST['ok'])) {

    $email = $mysqli->real_escape_string($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "Email inválido!";
    } else {
        // Usa prepared statement para evitar SQL Injection
        $stmt = $mysqli->prepare("SELECT id FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            $erro[] = "Esse email não existe no banco de dados.";
        } else {
            $novaSenha = substr(bin2hex(random_bytes(4)), 0, 8); // senha mais forte
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

            $assunto = "Sua nova senha";
            $mensagem = "Sua nova senha é: $novaSenha";
            $headers = "From: Rafaelrs100@hotmail.com\r\n";

            if (mail($email, $assunto, $mensagem, $headers)) {
                $stmtUpdate = $mysqli->prepare("UPDATE usuario SET senha = ? WHERE email = ?");
                $stmtUpdate->bind_param("ss", $senhaHash, $email);
                $stmtUpdate->execute();

                echo "<p style='color:green;'>Uma nova senha foi enviada para seu e-mail.</p>";
            } else {
                $erro[] = "Erro ao enviar o e-mail. Tente novamente mais tarde.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recuperar Senha - Meu Curso Online</title>
  <!-- Fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style/recuperar_senha.css">
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
        <h1 class="brand-title">Meu Curso Online</h1>
        <p class="brand-subtitle">Conectando conhecimento e oportunidades através da educação digital</p>
      </div>
    </div>

    <!-- Lado Direito - Formulário -->
    <div class="form-side">
      <div class="form-header">
        <h2 class="form-title">Recuperar Senha</h2>
        <p class="form-subtitle">Informe seu e-mail para receber as instruções de recuperação</p>
      </div>

      <form  method="POST" action="" class="recovery-form" id="recoveryForm">
        <div class="input-group">
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

        <button type="submit" class="recovery-button" name="ok" value="Recuperar Senha">
          Enviar Instruções
        </button>
      </form>
      
      <div class="signup-link">
        Lembrou da senha? <a href="login.php">Voltar para o Login</a>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("recoveryForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const email = document.getElementById("email").value;
      if (!email) {
        alert("Por favor, digite seu e-mail.");
        return;
      }
      if (!isValidEmail(email)) {
        alert("Por favor, digite um e-mail válido.");
        return;
      }
      alert("Instruções de recuperação de senha enviadas para " + email);
      // Aqui você pode adicionar a lógica para enviar o e-mail de recuperação
    });

    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  </script>
</body>
</html>

