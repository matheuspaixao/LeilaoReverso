<div class="row bg-gradient-danger p-2 text-white fixed-top" style="position: static">
    <div class="col-12 col-md-7 text-left">
        <img src="img/more+.jpg" height="40" alt="UVA">
    </div>
    <hr>
    <div class="col-6 col-md-4 text-right">
        <span>
            <?php
                if (isset($_SESSION['login'])) {
                    $user = $_SESSION['login'];
                    echo "Bem Vindo, $user<br/>\n";
                    $ds = array('Domingo', 
                                'Segunda-feira',
                                'Terça-feira',
                                'Quarta-feira',
                                'Quinta-feira',
                                'Sexta-feira',
                                'Sábado');
                    $dsn = date('w', strtotime("now"));
                    echo $ds[$dsn] . ", " . date("d/m/y")  . "</h6>";
                }
            ?>
        </span>
    </div>
    <div class="col-6 col-md-1 mt-1">
        <span>
            <a class="btn btn-success" data-toggle='tooltip' title='Página Inicial' href="inicio.php">
                <span class="fa fa-home"></span>
            </a>
            <a class="btn btn-success" data-toggle='tooltip' title='Sair' href="sair.php">
                <span class="fa fa-power-off"></span>
            </a>
        </span>
    </div>
</div>
