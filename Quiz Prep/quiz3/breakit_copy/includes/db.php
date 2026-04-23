<?php
// Database helper used by all quiz endpoints.

function get_db_config() {
    return [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'name' => getenv('DB_NAME') ?: 'quiz3',
        'user' => getenv('DB_USER') ?: 'root',
        'pass' => getenv('DB_PASS') ?: 'Liza7575',
        'charset' => 'utf8mb4'
    ];
}

function get_pdo($useDatabase = true) {
    $config = get_db_config();

    $dsn = 'mysql:host=' . $config['host'] . ';charset=' . $config['charset'];
    if ($useDatabase) {
        $dsn .= ';dbname=' . $config['name'];
    }

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    return new PDO($dsn, $config['user'], $config['pass'], $options);
}

function send_json($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function clean_player_name($name) {
    $name = trim($name ?? '');
    $name = preg_replace('/\s+/', ' ', $name);
    return substr($name, 0, 100);
}
?>
