<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Orçamento</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <?php include_once("nav/cabecalho.php");?>
    <div class="container">
      <div class="form-border col-12 col-sm-12 border">
        <form action="" method="post" accept-charset="utf-8" class="form-content border">
          <h2 class="text-center">Cadastrar Novo Orçamento</h2>
          <hr>
          <div class="form-row">
            <div class="col-md-12">
            <label class="col-form-label"> Nome do Orçamento</label>
            <input type="text" name="nome" id="nome" class="form-control input-lg" 
               placeholder="Nome do Orçamento" autofocus required/>
          </div>
            </div>
          <div class="form-row">
            <div class="col-md-4">
              <label class="col-form-label">Produto</label>
              <select name="produto"  id="instituicao" class="form-control input-lg">                            
                <option value="">Selecione...</option>                         
              </select>
            </div>
            <div class="col-md-2">
              <label class="col-form-label"> Quantidade</label>
              <input type="text" name="qtd" placeholder="Qtd_produto" required class="form-control input-lg">
            </div>
            <div class="col-md-3">
                <label class="col-form-label"> Unidade de Medida</label>
                <input type="text" name="und" placeholder="Und medida" required class="form-control input-lg">
            </div>
          </div>
          <div>
          <div class="form-row">
            <div class="col-md-3">
              <button type="submit" name="add_linha" class="btn btn-danger btn-block mt-3">
                Nova Linha 
              </button>
            </div>
            <div class="col-md-3">
              <button type="submit" name="add_prod" class="btn btn-danger btn-block mt-3">
                Adcionar Produto
              </button>
            </div>
            <div class="col-md-3">
              <a class="btn btn-danger btn-block mt-3" href="fornecedoras.php" role="button">
                  Avançar
              </a>
            </div>
          </div>
         </div>
        </form>
      </div>
      <?php include_once("nav/rodape.html");?>
    </div>
  </body>
</html>