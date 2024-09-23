<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Loteria</title>
    <link rel="stylesheet" href="/loteria/main.css">
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $valorApostado = $_POST["valor"];

            // Verifique se o valor é numérico
            if (!is_numeric($valorApostado) || $valorApostado == 0) {
                echo "<script>
                    alert('Erro: Você deve inserir um valor de aposta válido');
                    window.location.href = 'http://localhost/loteria/index.php'; 
                </script>";
            }

            $premio = $valorApostado * 50;
            $checkboxes = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : [];
            $listaNum = [];
            $nome = $_POST["nome"];

            // preenchendo o $listaNum com os números selecionados pelo user
            foreach ($checkboxes as $value) {
                array_push($listaNum , $value);
            }

            sort($listaNum); // ordenando o array em ordem crescente

            // Se o número de números selecionados for diferente de 25 ele recarregará a página
            if (count($listaNum) != 25) {
                echo "<script>
                    alert('Erro: Você deve selecionar exatamente 25 caixas.');
                    window.location.href = \"http://localhost/loteria/index.php\";
                </script>";
            }

            $numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11, 12, 13, 14, 15, 16, 17, 18, 19, 20,21, 22, 23, 24, 25, 26, 27, 28, 29, 30,31, 32, 33, 34, 35, 36, 37, 38, 39, 40,41, 42, 43, 44, 45, 46, 47, 48, 49, 50];
            shuffle($numeros); // embaralha os elementos do array
            $numerosSorteados = array_slice($numeros, 0, 25); // pega os primeiros 25 números do array

            sort($numerosSorteados); // ordenando o array em ordem crescente

            // verificando quais números o usuário acertou
            $numerosAcertados = [];
            foreach ($listaNum as $value) {
                if (in_array($value, $numerosSorteados)) {
                    array_push($numerosAcertados, $value);
                }
            }

            sort($numerosAcertados); // ordenando o array em ordem crescente
            $quantNumerosAcertados = count($numerosAcertados);

            // verifica se o usuário ganhou e exibe a mensagem
            echo "<div class='result-box'>"; // Início da box
            if ($quantNumerosAcertados == 25 || $quantNumerosAcertados == 0) {
                // exibindo mensagem principal de "você ganhou"
                echo "<h1>VOCÊ GANHOU R$ $premio !!!</h1>";

                // Exibindo os números escolhidos pelo usuário
                echo "<h2>Números escolhidos:</h2>";
                foreach ($listaNum as $value) {
                    echo " $value -";
                }

                // exibindo os números sorteados
                echo "<h2>Números sorteados:</h2>";
                foreach ($numerosSorteados as $value) {
                    echo " $value -";
                }

                // exibindo os números acertados
                echo "<h2>Números acertados:</h2>";
                echo "($quantNumerosAcertados) = ";
                foreach ($numerosAcertados as $value) {
                    echo " $value -";
                }
            } else {
                // exibindo mensagem principal de "você perdeu"
                echo "<h1>Você perdeu :(</h1>";

                // Exibindo os números escolhidos pelo usuário
                echo "<h2>Números escolhidos:</h2>";
                foreach ($listaNum as $value) {
                    echo " $value -";
                }

                // exibindo os números sorteados
                echo "<h2>Números sorteados:</h2>";
                foreach ($numerosSorteados as $value) {
                    echo " $value -";
                }

                // exibindo os números acertados
                echo "<h2>Números acertados:</h2>";
                echo "($quantNumerosAcertados) = ";
                foreach ($numerosAcertados as $value) {
                    echo " $value -";
                }

                // exibindo "tentar novamente"
                echo "<h3>TENTE NOVAMENTE !!!</h3>";
                echo "<button onclick=\"window.location.href='http://localhost/loteria/index.php'\">Tentar</button>";

                // Redireciona após 10 segundos
                echo "<script>
                    setTimeout(function() {
                        window.location.href = \"http://localhost/loteria/index.php\";
                    }, 10000);
                </script>";
            }
            echo "</div>"; // Fim da box
        }
    ?>
</body>
</html>