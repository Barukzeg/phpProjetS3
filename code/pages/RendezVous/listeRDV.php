<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/styleEDT.css">
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
                    if(!isset($_POST['tri'])){
                        $tri = $_POST['tri'] = 'chronological';
                    }
                    if($_POST['tri'] == 'nonChronological'){
                        $resultat = serviceRendezVous::getService()->getRDVChronological();
                        $tri = 'chronological';
                    }else{
                        $resultat = serviceRendezVous::getService()->getRDVNonChronological();
                        $tri = 'nonChronological';
                    }
                    echo '
                    <div class="affichageResult">
                        <table>
                            <tr>
                                <th>
                                    <form action="listeRDV.php" method="post">
                                        <input type="hidden" name="tri" value='.$tri.'>
                                        <button type="submit" class="tri">Date</button>
                                    </form>
                                </th>
                                <th>Heure</th>
                                <th>Durée</th>
                                <th>Usager</th>
                                <th>Médecin</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>';
                        if (!empty($resultat)) {
                            foreach ($resultat as $row) {
                                echo '
                                <tr>
                                    <td>'.$row->getDateEtHeure()->format('d/m/Y').'</td>
                                    <td>'.$row->getDateEtHeure()->format('H:i').'</td>
                                    <td>'.$row->getDureeMinutes().' min</td>
                                    <td>'.serviceUsager::getService()->get($row->getIdClient())->getNom().' '.serviceUsager::getService()->get($row->getIdClient())->getPrenom().'</td>
                                    <td>'.serviceMedecin::getService()->get($row->getIdMedecin())->getNom().' '.serviceMedecin::getService()->get($row->getIdMedecin())->getPrenom().'</td>
                                    <td>
                                        <form action="modRDV.php" method="post">
                                            <input type="hidden" name="idC" value="'.$row->getIdClient().'">
                                            <input type="hidden" name="idM" value="'.$row->getIdMedecin().'">
                                            <input type="hidden" name="DateEtHeure" value="'.$row->getDateEtHeure()->format('Y-m-d H:i').'">
                                            <button type="submit">Modifier</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="traitementDeleteRDV.php" method="post">
                                            <input type="hidden" name="idC" value="'.$row->getIdClient().'">
                                            <input type="hidden" name="idM" value="'.$row->getIdMedecin().'">
                                            <input type="hidden" name="DateEtHeure" value="'.$row->getDateEtHeure()->format('Y-m-d H:i').'">
                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                ';
                            }
                        } else {
                            echo '<tr><td colspan="7">Aucun rendez-vous</td></tr>';
                        }
                    echo '</div>';
                }catch (Exception $e){
                    echo $e->getMessage();
                }
            ?>
        </div>
    </body>
</html>