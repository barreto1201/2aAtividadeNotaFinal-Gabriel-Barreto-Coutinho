<?php

try {
    $db = new PDO("sqlite:livraria.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano INTEGER NOT NULL
        )"
    );
    
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
    exit;
}
?>
