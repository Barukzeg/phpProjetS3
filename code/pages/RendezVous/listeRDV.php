<html>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/listeUsager.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Liste des rendez-vous :</h1>
            <div class="bouton-add">
                <form action="addRDV.php">
                    <button>Ajouter un RDV</button>
                </form>
            </div>
            <?php
                include_once "../../services/serviceRendezVous.php";
                include_once "../../services/serviceUsager.php";
                include_once "../../services/serviceMedecin.php";
                include_once "../../modele/Usager.php";

                try{
                    $resultat = serviceRendezVous::getService()->getRDVChronological();
                    echo '<div class="affichageResult">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Durée</th>
                            <th>Usager</th>
                            <th>Médecin</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>';
                    foreach ($resultat as $row) {
                        echo '
                        <tr>
                            <td>'.$row->getDateEtHeure()->format('Y-m-d').'</td>
                            <td>'.$row->getDateEtHeure()->format('H:i').'</td>
                            <td>'.$row->getDureeMinutes().' min</td>
                            <td>'.serviceUsager::getService()->get($row->getIdClient())->getNom().' '.serviceUsager::getService()->get($row->getIdUsager())->getPrenom().'</td>
                            <td>'.serviceMedecin::getService()->get($row->getIdMedecin())->getNom().' '.serviceMedecin::getService()->get($row->getIdMedecin())->getPrenom().'</td>
                            <td>
                                <form action="modifRDV.php" method="post">
                                    <input type="hidden" name="idC" value="'.$row->getIdClient().'">
                                    <input type="hidden" name="idM" value="'.$row->getIdMedecin().'">
                                    <input type="hidden" name="DateEtHeure" value="'.$row->getDateEtHeure().'">
                                    <button type="submit">Modifier</button>
                                </form>
                            </td>
                            <td>
                                <form action="traitementDeleteRDV.php" method="post">
                                    <input type="hidden" name="idC" value="'.$row->getIdClient().'">
                                    <input type="hidden" name="idM" value="'.$row->getIdMedecin().'">
                                    <input type="hidden" name="DateEtHeure" value="'.$row->getDateEtHeure().'">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        ';
                    }
                    echo "</div>";
                }catch (Exception $e){
                    echo $e->getMessage();
                }
            ?>
        </div>
    </body>
</html>