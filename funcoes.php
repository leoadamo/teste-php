<?php

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
?>
