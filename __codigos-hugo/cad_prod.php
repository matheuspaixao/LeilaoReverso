<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Produto</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <?php include_once("nav/cabecalho.php");?>
    <div class="container">
      <div class="form-border col-12 col-sm-12 border">
        <form action="" method="post" accept-charset="utf-8" class="form-content border">
          <h2 class="text-center">Gerencia de Produtos </h2>
          <hr>
          <div class="form-row">
            <div class="col-md-4">
              <input type="text" name="produto" placeholder="Produto" required autofocus class="form-control">
            </div>
            <div class="col-md-4">
                <input type="text" name="produto" placeholder="Und medida" required class="form-control">
            </div>
            <div class="col-md-2">
              <button type="submit" name="alterar" class="btn btn-danger btn-block">
                 Alterar 
              </button>
            </div>
            <div class="col-md-2">
              <button type="submit" name="excluir" class="btn btn-danger btn-block">
                Excluir 
              </button>
            </div>
          </div>
          <div class="col-md-3 text-right">
            <button type="submit" name="add" class="btn btn-danger btn-block mt-3 btn-center">
                Adcionar Produto
            </button>
          </div>
        </form>
    </div>
    <?php include_once("nav/rodape.html");?>
    </div>
  </body>
</html>
