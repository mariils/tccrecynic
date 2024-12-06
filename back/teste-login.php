<!-- <?php
$senha = 'senha123'; // Senha fornecida no login
$hash = '$2y$10$ExemploDeHashGeradoPeloPHP/AlgoritmoDeCriptografia'; // Hash armazenado no banco

if (password_verify($senha, $hash)) {
    echo "Senha válida!";
} else {
    echo "Senha inválida!";
}
?>
