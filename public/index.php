<?php

use App\Models\Connection;

require_once "../vendor/autoload.php";

// Retrieve configuration
if (!file_exists(__DIR__ . '/../App/Config/config.php') || !file_exists(__DIR__ . '/../App/Config/integracao.php')) {

    if (!file_exists(__DIR__ . '/../App/Config/config.php')) {
?>


        <h3>Configurando o banco de dados</h3>
        <p>
            criar arquivo de configuração do banco no destino (<?= __DIR__ . '/../App/Config/config.php' ?>) veja o exemplo (<?= __DIR__ . '/../App/Config/config.php.dist' ?>)
        </p>
        <hr>



    <?php
    }
    if (!file_exists(__DIR__ . '/../App/Config/integracao.php')) {
    ?>
        <h3>Configurando a integração com a mLearn</h3>
        <p>
            criar arquivo de configuração da integração com a mLearn (<?= __DIR__ . '/../App/Config/integracao.php' ?>) veja o exemplo (<?= __DIR__ . '/../App/Config/integracao.php.dist' ?>)
        </p>
        <?php
    }
} else {
    require __DIR__ . '/../App/Config/config.php';
    require __DIR__ . '/../App/Config/integracao.php';




    @$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
    if (!$connection->connect_error) {
        $route = new \App\Route;
    } else {
        $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "CREATE DATABASE ". DB_NAME;
        if ($connection->query($sql) === TRUE) {
            echo "Database created successfully";
            $connection->select_db(DB_NAME);
            $query = file_get_contents("../db.sql");
            if (!$connection->multi_query($query)) {
                die("Connection failed: " . $connection->error);
            }
        ?>
            <script>
                location.reload();
            </script>
<?php
        } else {
            echo "Error creating database: " . $connection->error;
        }
    }
}
