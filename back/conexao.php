<?php
// URL de conexão fornecida pelo Railway
$dsn = 'mysql://root:EOujfgzHqZmEOxpewcHYrHKxapiIRzuR@junction.proxy.rlwy.net:51322/railway';

try {
    // Usando PDO para conexão
    $pdo = new PDO("mysql:host=junction.proxy.rlwy.net;dbname=railway;port=51322", 'root', 'EOujfgzHqZmEOxpewcHYrHKxapiIRzuR');
    
    // Definir o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se a conexão for bem-sucedida
    echo "";
} catch (PDOException $e) {
    // Se houver erro na conexão, exibe a mensagem de erro
    die("Erro na conexão: " . $e->getMessage());
}
?>
