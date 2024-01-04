<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MEMO | Liste de tâches</title>
    <meta name="description" content="Application Web de gestion de tâches - à produire dans le cadre du TP #2 du cours 582-3W3.">
    <link rel="stylesheet" href="ressources/css/styles.css">
    <link rel="icon" type="image/x-icon" href="ressources/images/favicon.ico">
</head>
<body>
    <div class="conteneur">
        <a href="index.php"><h1>MEMO</h1></a>
        <form method="post" autocomplete="off" action="index.php">
            <input type="text" name="texteTache" class="quoi-faire" autofocus placeholder="Tâche à accomplir ...">
        </form>
        <div class="filtres">
            <a href="index.php?filtrer=1" title="Afficher les tâches complétées uniquement.">Complétées</a>
            <a href="index.php?filtrer=0" title="Afficher les tâches non-complétées uniquement.">Non-complétées</a>
            <a href="index.php" title="Afficher toutes les tâches.">Toutes</a>
        </div>
        <ul class="liste-taches">
            <?php
            /**
             * Cette function se connecte a la base de donner et prend un tableau des
             * donnee et les retourne dans une variable
             * 
             * @param string $filtrer: Variable qui mets en ordre le tableau
             * 
             * @return array $result : Tableau de la base de donnee
             */ 
                function afficherTache ($filtrer) {
                    //connection
                    $conn = mysqli_connect('localhost', 'root', '', 'memo_e1870907');

                    if (isset($filtrer)) {
                        $sql = "SELECT id, texte, accomplie, DATE_FORMAT(date_ajout, '%d/%m/%Y à %T') as date_ajout FROM tache where accomplie = '" . $filtrer . "' order by date_ajout desc";
                    } else {
                        $sql = "SELECT id, texte, accomplie, DATE_FORMAT(date_ajout, '%d/%m/%Y à %T') as date_ajout FROM tache order by date_ajout desc";
                    }
                    $result = $conn->query($sql);

                    $conn->close();
                    //tableau
                    return $result;
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    //Capture le text 
                    $texte = $_POST["texteTache"];

                    $conn = mysqli_connect('localhost', 'root', '', 'memo_e1870907');
                    //Ajoute de nouvelle tache dans la base de donner
                    $sql = "INSERT INTO tache(id, texte, accomplie) VALUES (0, '" . $texte . "', '0') ";
                    $result = $conn->query($sql);

                    $conn->close();
                    //Apelle la function pour afficher les tache avec
                    //la nouvelle tache
                    $result = afficherTache(null);
                }

                if (isset($_GET["basculer"])) {
                    //Detecte si le href a ete clicker
                    $basculer = $_GET["basculer"];

                    $conn = mysqli_connect('localhost', 'root', '', 'memo_e1870907');
                    //Prend la ligne choici dans la base de donner
                    $sql = "SELECT accomplie from tache where id = " . $basculer;
                    $result = $conn->query($sql);

                    $ligne = $result->fetch_assoc();
                    //inverse la valeur accomplie
                    if ($ligne['accomplie'] == '0') {
                        $cibleAccomplie = '1';
                    } else {
                        $cibleAccomplie = '0';
                    }

                    $sql = "UPDATE tache SET accomplie = '" . $cibleAccomplie . "' where id = " . $basculer;
                    $result = $conn->query($sql);

                    $conn->close();
                    //Apelle la function qui affiche la base de donner
                    $result = afficherTache(null);
                }
                //Si il y a un filtre affiche seulement les taches filtrer
                if (isset($_GET["filtrer"])) {
                    $filtrer = $_GET["filtrer"];

                    $result = afficherTache($filtrer);
                } else {
                    $result = afficherTache(null);
                }
            ?> 
             <!-- boucle while : Pour toute les donnee de la base, la boucle va
            creer du code html.  -->
            <?php while($ligne = mysqli_fetch_assoc($result)): ?>
                <li <?php if($ligne['accomplie'] == '1'): ?>class="accomplie"<?php endif; ?>>
                    <span class="coche">
                        <a href="index.php?basculer=<?= $ligne['id']; ?>">
                            <img src="ressources/images/coche.svg" alt="">
                        </a>
                    </span>
                    <span class="texte"><?= $ligne["texte"]; ?></span>
                    <span class="ajout"><?= $ligne["date_ajout"]; ?></span>
                </li>
            <?php endwhile; ?>
            
        </ul>
    </div>
</body>
</html>