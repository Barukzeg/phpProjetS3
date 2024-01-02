<html>
    <head>
        <title>Statistiques</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/listeUsager.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Statistiques des clients :</h1>
            <h1>Statistiques des médecins :</h1>
            <?php
                echo 'haha';
                include_once "../../services/serviceStats.php";
                echo 'haha';
                try{
                    $resultat = serviceStats::getService()->getHeuresMedecins();
                    echo '<div class="affichageResult">';
                    foreach ($resultat as $row) {
                        echo '
                        <div class="result">
                            <div class="info">'
                                .$row['nom'].' '
                                .$row['prenom'].'<br>'
                                .'Nombre d\'heures : '.$row['heures'].'<br>
                            </div>
                        </div>';
                    }
                    echo "</div>";
                }catch (Exception $e){
                    echo $e->getMessage();
                }
            ?>
        </div>
    </body>
</html>