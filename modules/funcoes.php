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
    try {
      $sql = "SELECT * FROM posts ORDER BY data DESC";
      $query = $pdo->prepare($sql);
      $query->execute();
      $posts = $query->fetchAll();

      foreach ($posts as $post) {
        $id = $post['cdpost'];
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
          mostraExclui($id);
          mostraAltera($id);
        }
      }
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
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

    try {
      $sql = "SELECT * FROM posts $sqlAux ORDER BY data DESC";
      $query = $pdo->prepare($sql);
      $query->execute();
      $posts = $query->fetchAll();

      foreach($posts as $post) {  
        $id = $post['cdpost'];
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
          mostraExclui($id);
          mostraAltera($id);
        }
      }
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
    }  
  }  

  // Insere os dados provenientes do formulário de contato
  if(isset($_REQUEST['form-submit'])) {
    $nome = utf8_decode($_POST['nome']);
    $sobrenome = utf8_decode($_POST['sobrenome']);
    $email = utf8_decode($_POST['email']);
    $mensagem = utf8_decode($_POST['description']);
    // Chama a função insere já com as variáveis definidas
    insere($pdo, $nome, $sobrenome, $email, $mensagem);
  }
  
  // Executa a query
  function insere($pdo, $nome, $sobrenome, $email, $mensagem) {
    try {
      $sql = "INSERT INTO contato (nome, sobrenome, email, mensagem) VALUES (:nome, :sobrenome, :email, :mensagem)";
      $query = $pdo->prepare($sql);
      $query->bindValue(':nome', $nome);
      $query->bindValue(':sobrenome', $sobrenome);
      $query->bindValue(':email', $email);
      $query->bindValue(':mensagem', $mensagem);
      $query->execute();
      header("Location: ../index.php");
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
    }
  }

  // Insere os dados preenchidos no formulário de cadastro de postagens
  if(isset($_REQUEST['salvar'])) {
    $titulo = utf8_decode($_POST['titulo']);
    $resumo = utf8_decode($_POST['resumo']);
    $postagem = utf8_decode($_POST['postagem']);
    $imagem = $_FILES['imagem'];
    $posicao = utf8_decode($_POST['posicao']);
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
    try {
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
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
    }
  }

  // Botão exclui
  function mostraExclui($id) {
    $html = '<div class="buttons">
              <form method="POST">
                <button type="submit" name="exclui" value="excluir" class="submit-button query">Excluir</button>
                <input type="hidden" name="exclui" value="'.$id.'">
              </form>  
            </div>';
    echo $html;
  }

  // Botão Altera
  function mostraAltera($id) {
    $html = '<div class="buttons">
              <form method="POST" action="../teste-php/pages/altera_post.php">
                <button type="submit" name="altera" value="alterar" class="submit-button query">Alterar</button>
                <input type="hidden" name="altera" value="'.$id.'">
              </form>  
            </div>';
    echo $html;
  }

  // Botão Insere
  function botaoInsere() {
    $html = '<div class="insere-button">
              <form method="POST" action="../teste-php/pages/novo_post.php">
                <button type="submit" name="insere" value="inserir" class="submit-button query inserir">Novo Post</button>
              </form>  
            </div>';
    echo $html;        
  }  

  // Feature de exclusão
  if(isset($_REQUEST['exclui'])) {
    $cod = $_REQUEST['exclui'];

    // Chamada da função
    excluiPost($pdo, $cod);
  }

  function excluiPost($pdo, $cod) {
    try {
      $sql = "DELETE FROM posts WHERE cdpost = $cod";
      $query = $pdo->prepare($sql);
      $query->execute();
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
    }
    
  }

  // Feature de atualização
  if(isset($_REQUEST['altera'])) {
    $cod = $_REQUEST['altera'];
    try {
      $sql = "SELECT * FROM posts WHERE cdpost = $cod";
      $query = $pdo->prepare($sql);
      $query->execute();
      $posts = $query->fetch();
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
    }
    

    $codigo = $posts['cdpost'];
    $titulo = $posts['titulo'];
    $resumo = $posts['resumo'];
    $texto = $posts['texto'];
    $posicao = $posts['posicao'];
  }

  if(isset($_REQUEST['edita'])) {
    $codigo = utf8_decode($_REQUEST['codigo']);
    $titulo = utf8_decode($_REQUEST['titulo']);
    $resumo = utf8_decode($_REQUEST['resumo']);
    $texto = utf8_decode($_REQUEST['postagem']);
    $imagem = $_FILES['imagem'];
    $posicao = utf8_decode($_REQUEST['posicao']);

    $img_nome = $imagem['name'];
    $temp_file = $imagem['tmp_name'];
    $caminho = '../assets/img/'.$img_nome;
    move_uploaded_file($temp_file, $caminho);
    
    // Chamada da função
    atualizaPost($pdo, $codigo, $titulo, $resumo, $texto, $img_nome, $posicao);
    header("Location: ../index.php");
  }
  
  function atualizaPost($pdo, $codigo, $titulo, $resumo, $texto, $img_nome, $posicao) {
    try {
      $sql = "UPDATE posts SET titulo = '$titulo', resumo = '$resumo', texto = '$texto', imagem = '$img_nome', posicao = '$posicao' WHERE cdpost = $codigo";
      $query = $pdo->prepare($sql);
      $query->execute();
    } catch (PDOException $e) {
      echo "Falhou: ".$e->getMessage();
    }
  }
?>