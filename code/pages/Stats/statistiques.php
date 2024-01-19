<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <head>
        <title>Statistiques</title>
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/styleStats.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php
        include_once "../header.php";
        include_once "../../services/serviceStats.php";
    ?>
    <body>
        <div class="content">
            <h1>Statistiques des clients :</h1>
            <?php
                echo '
                <div class="statsClients">
                    <table>
                        <tr>
                            <th>Tranche d\'âge</th>
                            <th>Nombre d\'hommes</th>
                            <th>Nombre de femmes</th>
                        </tr>
                        <tr>
                            <td>Moins de 25 ans</td>
                            <td>'.serviceStats::getService()->getCountUsagerAgeSexe(0,0).'</td>
                            <td>'.serviceStats::getService()->getCountUsagerAgeSexe(0,1).'</td>
                        </tr>
                        <tr>
                            <td>Entre 25 et 50 ans </td>
                            <td>'.serviceStats::getService()->getCountUsagerAgeSexe(1,0).'</td>
                            <td>'.serviceStats::getService()->getCountUsagerAgeSexe(1,1).'</td>
                        </tr>
                        <tr>
                            <td>Plus de 50 ans</td>
                            <td>'.serviceStats::getService()->getCountUsagerAgeSexe(2,0).'</td>
                            <td>'.serviceStats::getService()->getCountUsagerAgeSexe(2,1).'</td>
                        </tr>
                    </table>
                </div>';
            ?>
            <h1>Statistiques des médecins :</h1>
            <?php
                try{
                    $resultat = serviceStats::getService()->getHeuresMedecins();
                    echo '<div class="statsMedecin">';
                    foreach ($resultat as $row) {
                        echo '
                        <div class="info">'
                            .$row['nom'].' '
                            .$row['prenom'].'<br>'
                            .'Nombre d\'heures : '.$row['heures'].'<br>
                        </div>';
                    }
                    echo "</div>";
                }catch (Exception $e){
                    header('Location: ../erreur.php');
                    exit();
                }
            ?>
        </div>
    </body>
</html>