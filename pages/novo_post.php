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
  <link rel="stylesheet" href="../assets/css/cadastro.css" />
  <link rel="icon" type="img/png" href="../assets/svg/fire.png">
  <title>Blog From Hell - Novo Post</title>
</head>

<body>
  <header class="menu-bg">
    <div class="menu-logo">
      <a href="../index.php"><img src="../assets/svg/php-logo.png" alt="PHP Logo"></a>
    </div>
  </header>

  <div class="container form-post">
    <h1 class="title blue"><span>&#62;</span>Insira as informações do post<span>&#46;</span></h1>
    <div class="form grid-8">
      <form id="new_post" action="../modules/funcoes.php" class="general-form" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label><input type="text" name="titulo" id="titulo" placeholder="Título da Postagem">
        <label for="resumo">Resumo: </label><input type="text" name="resumo" id="resumo" placeholder="Resumo do post...">
        <label for="postagem">Postagem: </label><textarea name="postagem" id="postagem" cols="50" rows="8"
            placeholder="Insira o post aqui."></textarea>
        <label for="imagem">Imagem: </label><input type="file" name="imagem" id="imagem">
        <label for="posicao">Posição: </label><input type="text" name="posicao" id="posicao" placeholder="Insira onde a imagem será posicionada.">
        <button type="submit" name="salvar" value="salvar" class="submit-button">Salvar</button>
      </form>
    </div>  
  </div>

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