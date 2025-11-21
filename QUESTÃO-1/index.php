<?php
require 'database.php';

$livros = $db->query("SELECT * FROM livros ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title> Livraria com Banco de Dados </title>
        <style>
            body {
                color: #333;
                background: linear-gradient(135deg, #6a11cb, #2575fc);
                font-family: "Segoe UI", Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .caixa_geral {
                background: #ffffffdd;
                box-shadow: 0 8px 25px rgba(0,0,0,0.25);
                backdrop-filter: blur(5px);
                max-width: 900px;
                margin: 40px auto;
                padding: 30px;
                border-radius: 15px;
            }

            h1 {
                color: #222;
                text-align: center;
                margin-bottom: 20px;
                font-size: 32px;
            }

            h2 {
                color: #444;
                margin-top: 30px;
            }

            form {
                background: #f8f8f8;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 25px;
                padding: 15px;
                border-radius: 12px;
            }

            input {
                border: 1px solid #ccc;
                flex: 1;
                padding: 12px;
                border-radius: 8px;
                font-size: 15px;
            }

            button {
                background: #2575fc;
                border: none;
                color: white;
                cursor: pointer;
                font-weight: bold;
                padding: 12px 18px;
                transition: 0.25s;
                border-radius: 8px;
            }

            button:hover {
                background: #0b57d8;
            }

            table {
                overflow: hidden;
                border-collapse: collapse;
                width: 100%;
                margin-top: 15px;
                border-radius: 12px;
            }

            th {
                background: #2575fc;
                color: white;
                text-align: left;
                padding: 12px;
                font-size: 16px;
            }

            td {
                border-bottom: 1px solid #ddd;
                background: white;
                padding: 12px;
            }

            tr:hover td {
                background: #eef4ff;
            }

            .botao_deletar {
                background: #ff3b3b;
                color: white;
                text-decoration: none;
                padding: 7px 15px;
                border-radius: 6px;
                font-size: 14px;
                transition: 0.25s;
            }

            .botao_deletar:hover {
                background: #d62828;
            }
        </style>
    </head>
    <body>
        <div class="caixa_geral">

            <h1> Livraria </h1>

            <h2> Adicionar Livro </h2>
            <form action="add_book.php" method="POST" style="text-align: center">
                <input type="text" name="titulo" placeholder="Título" required>
                <input type="text" name="autor" placeholder="Autor" required>
                <input type="number" name="ano" placeholder="Ano" required>
                <button type="submit">Adicionar</button>
            </form>

            <h2> Lista de Livros </h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?= htmlspecialchars($livro['id']) ?></td>
                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td><?= htmlspecialchars($livro['autor']) ?></td>
                        <td><?= htmlspecialchars($livro['ano']) ?></td>
                        <td>
                            <a class="botao_deletar" href="delete_book.php?id=<?= $livro['id'] ?>"
                            onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach?>
            </table>
        </div>
    </body>
</html>
