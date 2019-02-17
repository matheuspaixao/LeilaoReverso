<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
     <?php include_once("nav/cabecalho.php");?>
    <div class="container">
        <div class="form-border border col-10 col-md-4">
          <form action="" method="post" accept-charset="utf-8" class="form-content border">
            <h4 class="form-login-heading text center">Login</h4>
            <hr>
          <div class="form-group">
            <input type="text" name="login" placeholder="usuário" class="form-control form-control-fa" required autofocus>
          </div>
          <div class="form-group">
            <input type="password" name="senha" placeholder="senha" class="form-control form-control-fa"  required>
          </div>
          <a class="btn btn-danger btn-block mt-3" href="inicial.php" role="button">
                  Entar
        </a>
        </form>
      </div>
    </div>
    <?php
      include_once("nav/rodape.html");
    ?>
  </body>
</html>
