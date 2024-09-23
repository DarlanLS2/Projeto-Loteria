<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/loteria/style.css">
</head>
<body>
    <div>
        <img src="/loteria/caixa.png">
        <!-- formulario com metodo post que ao apertar o botao de submit sera redirecionado para o main.php -->
        <form action="/loteria/main.php" method="post">
            <!-- input nome -->
            <label for="nome">Escreva seu Nome:</label>
            <input type="text" name="nome" required>
            <!-- input valor apostado -->
            <label for="valor">Digite o valor da aposta</labe>
            <input type-="number" name="valor" required>
            <br>
            <?php
                // Gera 50 checkboxes
                for ($i = 1; $i <= 50; $i++) {
                    echo '<label for="' . $i . '">' . $i . '</label>';
                    echo '<input type="checkbox" name="checkboxes[]" value="' . $i . '">';
                }
            ?>
            <br>
            <!-- botao de Enviar -->
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
