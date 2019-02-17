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
        <div class="table-wrapper-scroll-y">
            <table cellspacing="0" class=" table table-striped table-hover table-sm" width="100%">
                <thead class="bg-secondary">
                    <tr>
                        <th><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
                        <th>Fornecedoras</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" value="1" name="marcar[]" /></td>
                        <td>
                            Depósito São José
                        </td>
                    </tr>

                </tbody>
            </table>
          </div>
      </div>
      <?php include_once("nav/rodape.html");?>
    </div>
  </body>
</html>