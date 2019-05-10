<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/grid.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/login.css" />
  <link rel="icon" type="img/png" href="../assets/svg/fire.png">
  <title>Blog From Hell - Login</title>
</head>

<body>
  <header class="menu-bg">
    <div class="menu-logo">
      <a href="../index.php"><img src="../assets/svg/php-logo.png" alt="PHP Logo"></a>
    </div>
  </header>

  <section id="login">
    <div class="form">
      <h1 class="title"><span>&#126;</span>Faça seu Login<span>&#46;</span></h1>
      <form id="register" action="../modules/sessao.php" class="contact-form" method="POST">
        <label for="nome">Usuário: </label><input type="text" name="usuario" id="usuario" placeholder="Usuário">
        <label for="sobrenome">Senha: </label><input type="password" name="senha" id="senha" placeholder="Senha">
        <button type="submit" name="login" class="submit-button">Login</button>
      </form>
    </div>
  </section>

  <footer>
    <div class="social container">
      <h2>Redes Sociais</h2>
      <ul>
        <li><a href="https://www.facebook.com" target="_blank"><img src="../assets/svg/social/facebook-logo.png"
              alt="Facebook" /></a></li>
        <li><a href="https://www.instagram.com" target="_blank"><img src="../assets/svg/social/instagram-logo.png"
              alt="Instagram" /></a></li>
        <li><a href="https://www.twitter.com" target="_blank"><img src="../assets/svg/social/twitter-logo.png"
              alt="Twitter" /></a></li>
      </ul>
    </div>
    <div class="copy">
      <p>&copy;Leonardo Adamoli - Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Javascript Here -->
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>