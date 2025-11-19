<?php

try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=jo;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch(PDOException $e){
    die("Erreur PDO : " . $e->getMessage());
}


$filtreNom = "";
$filtrePays = "";
$filtreCourse = "";
$filtreTempsMin = ""; 
$filtreTempsMax = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filtreNom = isset($_POST["filtre_nom"]) ? trim($_POST["filtre_nom"]) : "";
    $filtrePays = isset($_POST["filtre_pays"]) ? trim($_POST["filtre_pays"]) : "";
    $filtreCourse = isset($_POST["filtre_course"]) ? trim($_POST["filtre_course"]) : "";
    $filtreTempsMin = isset($_POST["filtre_temps_min"]) ? trim($_POST["filtre_temps_min"]) : "";
    $filtreTempsMax = isset($_POST["filtre_temps_max"]) ? trim($_POST["filtre_temps_max"]) : "";
}


$sort = "nom";
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}
$order = "asc";
if (isset($_GET['order'])) {
    $order = $_GET['order'];
}

$allowedSort = ["nom", "pays", "course", "temps"];
$allowedOrder = ["asc", "desc"];

if (!in_array($sort, $allowedSort)) {
    $sort = "nom";
}
if (!in_array($order, $allowedOrder)) {
    $order = "asc";
}


$whereClauses = [];
$params = [];


if ($filtreNom !== "") {
    $whereClauses[] = "nom LIKE :nom";
    $params[':nom'] = "%$filtreNom%";
}
if ($filtrePays !== "") {
    $whereClauses[] = "pays LIKE :pays";
    $params[':pays'] = "%$filtrePays%";
}
if ($filtreCourse !== "") {
    $whereClauses[] = "course LIKE :course";
    $params[':course'] = "%$filtreCourse%";
}


if ($filtreTempsMin !== "" && is_numeric($filtreTempsMin)) {
    $whereClauses[] = "temps >= :tempsMin";
    $params[':tempsMin'] = (float)$filtreTempsMin;
}
if ($filtreTempsMax !== "" && is_numeric($filtreTempsMax)) {
    $whereClauses[] = "temps <= :tempsMax";
    $params[':tempsMax'] = (float)$filtreTempsMax;
}


$whereSQL = "";
if (!empty($whereClauses)) {
    $whereSQL = "WHERE " . implode(" AND ", $whereClauses);
}


$sql = "SELECT * FROM jo.`100` $whereSQL ORDER BY $sort $order";

$stmt = $mysqlClient->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


$mysqlClient = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Recherche Athlètes</title>
</head>
<body>

<h2>Filtrer </h2>
<form method="POST" action="">
    <label>Nom : <input type="text" name="filtre_nom" value="<?= htmlspecialchars($filtreNom) ?>"></label><br><br>
    <label>Pays : <input type="text" name="filtre_pays" value="<?= htmlspecialchars($filtrePays) ?>"></label><br><br>
    <label>Course : <input type="text" name="filtre_course" value="<?= htmlspecialchars($filtreCourse) ?>"></label><br><br>

    <label>Temps min : <input type="text" name="filtre_temps_min" placeholder="ex: 9.58" value="<?= htmlspecialchars($filtreTempsMin) ?>"></label><br><br>
    <label>Temps max : <input type="text" name="filtre_temps_max" placeholder="ex: 12.00" value="<?= htmlspecialchars($filtreTempsMax) ?>"></label><br><br>

    <button type="submit">Appliquer les filtres</button>
    <button type="button" onclick="window.location.href='<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>'">Reset</button>
</form>

<hr>

<h2>Trier</h2>
<p>
    Nom :
    <a href="?sort=nom&order=asc">↑</a>
    <a href="?sort=nom&order=desc">↓</a>
</p>

<p>
    Pays :
    <a href="?sort=pays&order=asc">↑</a>
    <a href="?sort=pays&order=desc">↓</a>
</p>

<p>
    Course :
    <a href="?sort=course&order=asc">↑</a>
    <a href="?sort=course&order=desc">↓</a>
</p>

<p>
    Temps :
    <a href="?sort=temps&order=asc">↑</a>
    <a href="?sort=temps&order=desc">↓</a>
</p>

<hr>

<h2>Résultats</h2>

<?php if (empty($data)): ?>
    <p>Aucun résultat.</p>
<?php else: ?>
    <?php foreach ($data as $value): ?>
        <p>
            <strong>Nom :</strong> <?= htmlspecialchars($value["nom"]) ?><br>
            <strong>Pays :</strong> <?= htmlspecialchars($value["pays"]) ?><br>
            <strong>Course :</strong> <?= htmlspecialchars($value["course"]) ?><br>
            <strong>Temps :</strong> <?= htmlspecialchars($value["temps"]) ?><br>
        </p>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>

