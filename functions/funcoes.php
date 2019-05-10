<?php

  // Configura o PHP para o português Brasil
  setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  // Seta o nosso fuso horário ao PHP
  date_default_timezone_set('America/Sao_Paulo');

  // Cria a string de conexão ao banco, setando o banco, nome do bd e o host
  $dsn = "mysql:dbname=blog-php;host=127.0.0.1";
  // Variável para o user
  $dbuser = "root";
  // Variável para a senha
  $dbpass = "";

  try {
  // Utiliza o PDO passando como parâmetros os dados para conexão ao banco
  // Armazena os dados da conexão à variável $pdo, passando também os métodos da POO presentes nessa função
  $pdo = new PDO($dsn, $dbuser, $dbpass);
  } catch (PDOException $e) {
    echo "Falhou: ".$e->getMessage();
  }

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

  function mostraBotao() {
    $html = '<div class="buttons">
              <button type="submit" name="form-submit" value="inserir" class="submit-button query">Inserir</button>
              <button type="submit" name="form-submit" value="alterar" class="submit-button query">Alterar</button>
              <button type="submit" name="form-submit" value="excluir" class="submit-button query">Excluir</button>
            </div>';

    echo $html;
  }
?>
