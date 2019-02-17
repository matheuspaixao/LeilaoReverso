<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Inicial</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
    
<body>
    <?php include_once("nav/cabecalho.php");?>
     <div class="container-fluid">
        <div class="row icones">
          <div class="col-12 col-sm-6 col-md-4 text-center">
            <a href="cad_prod.php">
              <img src="img/produtos.png" height="80">
               <h5 class="mt-2 text-dark">Gerenciar Produtos</h5>
            </a>
          </div>
          <div class="col-12 col-sm-6 col-md-4 text-center">
            <a href="cad_orcamento.php">
              <img src="img/orcamento.png" height="80">
               <h5 class="mt-2 text-dark">Cadastrar Orçamentos</h5>
            </a>
          </div>
        </div>
      </div>
    <?php include_once("nav/rodape.html");?>
  </body>
</html>