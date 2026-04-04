<?php

$host = 'srv1077.hstgr.io';
#$host = 'localhost';
$db   = 'u391950094_BotWhatsApp';
$user = 'u391950094_BotWhatsApp';
$pass = '';
$arquivoSenha = __DIR__ . '/../../env/envPass';

if (is_file($arquivoSenha)) {
    $linhas = file($arquivoSenha, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    $valores = [];

    foreach ($linhas as $linha) {
        $linha = trim($linha);
        if ($linha === '' || strpos($linha, '#') === 0) {
            continue;
        }

        if (strpos($linha, '=') !== false) {
            [$chave, $valor] = explode('=', $linha, 2);
            $valores[trim($chave)] = trim($valor);
        }
    }

    $conteudoBruto = trim((string) file_get_contents($arquivoSenha));
    $pass = $valores['DB_PASSWORD'] ?? $conteudoBruto;
}
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erro conexão: ' . $e->getMessage());
}
