<?php
session_start();
session_unset();
session_destroy();

header("Location: ../index.html");

$translations = [
	'en' => "Session successfully terminated.",
	'pt' => "Sessão terminada com sucesso."
];


$allowed_languages = ['en', 'pt'];
$lang = isset($_GET['lang']) && in_array($_GET['lang'], $allowed_languages) ? $_GET['lang'] : 'pt';
$safe_lang = preg_replace('/[^a-z]/', '', $lang);
$message = $translations[$lang] ?? $translations['en'];
$redirect_url = "../index.html";
?>
<!DOCTYPE html>
<html lang="<?= $safe_lang ?>">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="3;url=<?= htmlspecialchars($redirect_url) ?>">
	<title>Logout</title>
</head>
<body>
	<p><?= htmlspecialchars($message) ?></p>
	<p>Serás redirecionado em 3 segundos...</p>
</body>
</html>
