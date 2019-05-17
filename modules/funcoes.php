<?php

  // conecta ao DB
  include("db-conector.php");

  //Arrumar a data
  function data_br($data) {
    //2018-06-26
    $data = explode('-', $data);
    // array([0] => 2018 , [1] => 06 , [2] => 26)
    $data = array_reverse($data);
    $data = implode('/',$data );
    return $data;
  } 
  
  // Listar os posts cadastrados no BD  
  function listar($pdo) {
    $sql = "SELECT * FROM posts ORDER BY data DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $posts = $query->fetchAll();

    foreach ($posts as $post) {
      $html = '<div class="postagens">
                <h2>'.$post['titulo'].'</h2>
                <p>'.$post['resumo'].'</p><br><br>
                <p>'.$post['texto'].'</p>
                <div class="pictures" style="text-align: '.$post['posicao'].';">
                  <img src="assets/img/'.$post['imagem'].'" alt="">
                </div>    
                <p class="data"><strong>Data da postagem:</strong> '.data_br($post['data']).'</p>
              </div>';
      echo utf8_encode($html);
      if(isset($_SESSION['usuario'])) {
        mostraBotoes();
      }
    }
  }

  // Listar os posts que contenham a inicial passada na caixa de pesquisa
  function listarInicial($pdo) {
    $inicial = "";
    $sqlAux = "";

    if(isset($_REQUEST['buscar']))
      $inicial = $_REQUEST['pesquisa'];
      
    if($inicial != "") 
      $sqlAux = " WHERE titulo LIKE '$inicial%'";

    $sql = "SELECT * FROM posts $sqlAux ORDER BY data DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $posts = $query->fetchAll();
      
    foreach($posts as $post) {  
      $html = '<div class="postagens">
                <h2>'.$post['titulo'].'</h2>
                <p>'.$post['resumo'].'</p><br><br>
                <p>'.$post['texto'].'</p>
                <div class="pictures" style="text-align: '.$post['posicao'].';">
                  <img src="assets/img/'.$post['imagem'].'" alt="">
                </div> 
                <p class="data"><strong>Data da postagem:</strong> '.data_br($post['data']).'</p>
              </div>';
      echo utf8_encode($html);
      if(isset($_SESSION['usuario'])) {
        mostraBotoes();
      }
    }
  }  

  // Insere os dados provenientes do formulário
  if(isset($_REQUEST['form-submit'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $mensagem = $_POST['description'];
    // Chama a função insere já com as variáveis definidas
    insere($pdo, $nome, $sobrenome, $email, $mensagem);
  }
  
  // Executa a query
  function insere($pdo, $nome, $sobrenome, $email, $mensagem) {
    $sql = "INSERT INTO contato (nome, sobrenome, email, mensagem) VALUES (:nome, :sobrenome, :email, :mensagem)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':nome', $nome);
    $query->bindValue(':sobrenome', $sobrenome);
    $query->bindValue(':email', $email);
    $query->bindValue(':mensagem', $mensagem);
    $query->execute();
    header("Location: ../index.php");
  }

  // Insere os dados preenchidos no formulário de cadastro de postagens
  if(isset($_REQUEST['salvar'])) {
    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $postagem = $_POST['postagem'];
    $imagem = $_FILES['imagem'];
    $posicao = $_POST['posicao'];
    $data = date('Y-m-d');
 
    $img_nome = $imagem['name'];
    $temp_file = $imagem['tmp_name'];
    $caminho = '../assets/img/'.$img_nome;
    move_uploaded_file($temp_file, $caminho);
    
    // Chamando a função que executará a query de cadastro de postagem
    criaPost($pdo, $titulo, $resumo, $postagem, $img_nome, $posicao, $data);
  }

  // Função criaPost
  function criaPost($pdo, $titulo, $resumo, $postagem, $img_nome, $posicao, $data) {
    $sql = "INSERT INTO posts (titulo, resumo, texto, imagem, posicao, data) VALUES (:titulo, :resumo, :postagem, :imagem, :posicao, :dt_post)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':titulo', $titulo);
    $query->bindValue(':resumo', $resumo);
    $query->bindValue(':postagem', $postagem);
    $query->bindValue(':imagem', $img_nome);
    $query->bindValue(':posicao', $posicao);
    $query->bindValue(':dt_post', $data);
    $query->execute();
    header('Location: ../index.php');
  }

  function mostraBotoes() {
    $html = '<div class="buttons">
              <form method="POST">
                <button type="submit" name="atualiza" value="alterar" class="submit-button query">Alterar</button>
                <button type="submit" name="exclui" value="excluir" class="submit-button query">Excluir</button>
              </form>
            </div>';
    echo $html;
  }

  function botaoInsere() {
    $html = '<div class="insere-button">
              <form method="POST" action="../teste-php/pages/novo_post.php">
                <button type="submit" name="insere" value="inserir" class="submit-button query inserir">Novo Post</button>
              </form>  
            </div>';
    echo ($html);        
  }  
?>