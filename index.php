<?php
    include('funcoes.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/grid.css" />
  <link rel="stylesheet" href="assets/css/vegas.min.css">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="icon" type="img/png" href="assets/svg/fire.png">
  <title>Blog From Hell</title>
</head>

<body>
  <header class="menu-bg">
    <div class="container">
      <div class="menu-logo grid-4">
        <a href="index.php"><img src="assets/svg/php-logo.png" alt="PHP Logo"></a>
      </div>
      <nav class="nav-bar grid-12 to-scroll">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#posts">Postagens</a></li>
          <li><a href="#sobre">Sobre</a></li>
          <li><a href="#contact">Contato</a></li>
          <li><a href="#">Login</a></li>
        </ul>
      </nav>
      <form action="index.php" method="GET" class="search-form grid-16">
        <input type="text" placeholder="Pesquisar..." name="pesquisa">
        <button type="submit" name="buscar" value="buscar">Buscar</button>
      </form>
    </div>
  </header>

  <div id="bg-slider" class="intro-bg">
    <div class="intro-description container">
      <h1>Lógica de Programação para WEB</h1>
      <p>Blog From Hell</p>
    </div>
    <div class="button to-scroll">
      <a href="#posts">Confira!</a>
    </div>
  </div>

  <section id="sobre" class="sobre">
    <div class="container">
      <div class="grid-16">
        <h1 class="title blue"><span>/</span> Sobre Nós</h1>
      </div>
      <blockquote>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus dolorem eius consequatur, neque nulla eos
          consectetur corrupti pariatus.<p>
      </blockquote>
      <cite>Lorem Ipsum</cite>
    </div>
  </section>

  <section id="posts" class="posts-bg">
    <div class="container">
      <div class="news grid-16">
        <h1 class="title"><span>/</span> Postagens</h1>
        <?php 
          if(isset($_REQUEST['buscar']))
            listarInicial($pdo);
          else
            listar($pdo);  
        ?>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="form grid-8">
        <h1 class="title blue"><span>/</span> Contato</h1>
        <form id="contact-us" action="funcoes.php" class="contact-form" method="POST">
          <label for="nome">Nome: </label><input type="text" name="nome" id="nome" placeholder="Nome">
          <label for="sobrenome">Sobrenome: </label><input type="text" name="sobrenome" id="sobrenome"
            placeholder="Sobrenome">
          <label for="email">e-mail: </label><input type="text" name="email" id="email"
            placeholder="seuemailaqui@provedor.com">
          <label for="description">Mensagem: </label><textarea name="description" id="description" cols="50" rows="8"
            placeholder="Insira sua mensagem aqui"></textarea>
          <button type="submit" name="form-submit" class="submit-button">Enviar</button>
        </form>
      </div>
    </div>
  </section>

  <footer>
    <div class="social container">
      <h2>Redes Sociais</h2>
      <ul>
        <li><a href="https://www.facebook.com" target="_blank"><img src="assets/svg/social/facebook-logo.png"
              alt="Facebook" /></a></li>
        <li><a href="https://www.instagram.com" target="_blank"><img src="assets/svg/social/instagram-logo.png"
              alt="Instagram" /></a></li>
        <li><a href="https://www.twitter.com" target="_blank"><img src="assets/svg/social/twitter-logo.png"
              alt="Twitter" /></a></li>
      </ul>
    </div>
    <div class="copy">
      <p>&copy;Leonardo Adamoli - Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Javascript here -->
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="assets/js/plugins/vegas.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>