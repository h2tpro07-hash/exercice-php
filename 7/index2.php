<?php
// TP 7 - Variable de session (Login simple)
session_start();

// Déconnexion
if (isset($_GET['logout'])) {
    session_unset();   // Supprime toutes les variables de session
    session_destroy(); // Détruit la session
    header("Location: index.php"); // Redirection vers la page de login
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
}

// Vérifier si la variable de session username existe
if (isset($_SESSION['username'])) {
    echo "<h1>Bonjour " . $_SESSION['username'] . "</h1>";
    echo '<a href="?logout=1"><button>Déconnexion</button></a>';
} else {
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
    body { font-family: Arial, sans-serif; padding: 50px; }
    .login-form { max-width: 300px; }
    label { display: block; margin-bottom: 5px; }
    input[type="text"] { padding: 5px; width: 200px; margin-bottom: 10px; }
    button { padding: 5px 15px; cursor: pointer; }
</style>
</head>
<body>
<div class="login-form">
<h2>Login</h2>
<form method="POST" action="">
<label for="username">Username :</label>
<input type="text" id="username" name="username" required>
<button type="submit">Valider</button>
</form>
</div>
</body>
</html>
<?php
}
?>


