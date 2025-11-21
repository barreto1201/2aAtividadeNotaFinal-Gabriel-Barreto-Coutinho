<?php
require 'database.php';

$pendentes = $db->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY vencimento")->fetchAll(PDO::FETCH_ASSOC);
$concluidas = $db->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY vencimento")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title> Gerenciador de Tarefas </title>
        <style>
            body {
                background: linear-gradient(135deg, #6a11cb, #2575fc);
                font-family: "Segoe UI", Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            header {
                background: #193191ff;
                box-shadow: 0 3px 6px rgba(0,0,0,0.2);
                color: white;
                text-align: center;
                font-weight: bold;
                font-size: 26px;
                padding: 20px;
                letter-spacing: 1px;
            }

            .caixa_geral {
                width: 90%;
                max-width: 900px;
                margin: 30px auto;
            }

            .bloco {
                background: white;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                padding: 20px;
                margin-bottom: 25px;
                border-radius: 12px;
            }

            h2 {
                color: #333;
                text-align: center;
                margin-top: 0;
            }

            p {
                text-align: center;
            }

            input {
                border: 1px solid #bbb;
                padding: 10px;
                margin: 6px 0;
                border-radius: 8px;
                width: 97.5%;
                font-size: 14px;
            }

            button {
                background: #4a6cf7;
                border: 1px solid #bbb;
                color: white;
                border: none;
                cursor: pointer;
                font-weight: bold;
                transition: 0.2s;
                padding: 10px;
                margin: 6px 0;
                border-radius: 8px;
                width: 100%;
                font-size: 14px;
            }

            button:hover {
                background: #3a59d6;
            }

            table {
                border-collapse: collapse;
                overflow: hidden;
                width: 100%;
                margin-top: 15px;
                border-radius: 12px;
            }

            th {
                background: #4a6cf7;
                color: white;
            }

            th, td {
                border-bottom: 1px solid #ddd;
                text-align: left;
                padding: 12px;
            }

            tr:hover {
                background: #f2f4ff;
            }

            .botao_menor {
                background: #4a6cf7;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                padding: 6px 10px;
                font-size: 12px;
                transition: 0.2s;
            }

            .botao_menor:hover {
                background: #3a59d6;
            }

            .botao_deletar {
                background: #ff4d4d;
            }

            .botao_deletar:hover {
                background: #d93636;
            }

            .concluido {
                color: green;
                font-weight: bold;
            }

            .pendente {
                color: #e0e406ff;
                font-weight: bold;
            }
        </style>
    </head>
    <body>

        <header> Gerenciador de Tarefas </header>

        <div class="caixa_geral">

            <div class="bloco">
                <h2> Adicionar Nova Tarefa </h2>
                <form action="add_tarefa.php" method="POST">
                    <input type="text" name="descricao" placeholder="Descrição da tarefa" required>
                    <input type="date" name="vencimento" required>
                    <button type="submit">Adicionar Tarefa</button>
                </form>
            </div>

            <div class="bloco">
                <h2> Tarefas Pendentes </h2>

                <?php if (empty($pendentes)): ?>
                    <p> Nenhuma tarefa pendente </p>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>

                        <?php foreach ($pendentes as $t): ?>
                            <tr>
                                <td><?= $t['id'] ?></td>
                                <td><?= htmlspecialchars($t['descricao']) ?></td>
                                <td><?= date('d/m/Y', strtotime($t['vencimento'])) ?></td>
                                <td class="pendente">⚠ Pendente</td>
                                <td>
                                    <a class="botao_menor" href="update_tarefa.php?id=<?= $t['id'] ?>">Concluir</a>
                                    <a class="botao_menor botao_deletar" href="delete_tarefa.php?id=<?= $t['id'] ?>" 
                                    onclick="return confirm('Excluir tarefa?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </table>
                <?php endif?>
            </div>

            <div class="bloco">
                <h2> Tarefas Concluídas </h2>

                <?php if (empty($concluidas)): ?>
                    <p> Nenhuma tarefa concluída ainda </p>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>

                        <?php foreach ($concluidas as $t): ?>
                            <tr>
                                <td><?= $t['id'] ?></td>
                                <td><?= htmlspecialchars($t['descricao']) ?></td>
                                <td><?= date('d/m/Y', strtotime($t['vencimento'])) ?></td>
                                <td class="concluido">✔ Concluída</td>
                                <td>
                                    <a class="botao_menor botao_deletar" href="delete_tarefa.php?id=<?= $t['id'] ?>"
                                    onclick="return confirm('Excluir tarefa concluída?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif?>
            </div>
        </div>
    </body>
</html>
