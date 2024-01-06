<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <head>
        <title>Liste des usagers</title>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/styleEDT.css">
    </head>
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Liste des rendez-vous :</h1>
            <div class="top">
                <div class="menu-deroulant">
                    <form action="listeRDV.php" method="post">
                        <label for="medecin">Trier par médecin :</label>
                        <select id="medecin" name="medecin">
                            <option value="null" <?php
                                if(!isset($_POST['medecin']) || $_POST['medecin'] == 'null'){
                                    echo 'selected';
                                } ?>>-- médecin --</option>
                            <?php
                                include_once "../../services/serviceMedecin.php";
                                $medecins = serviceMedecin::getService()->getMedecinAlpha();
                                foreach ($medecins as $medecin) {
                                    echo "<option value='".$medecin->getIdMedecin()."' ";
                                    if (isset($_POST['medecin']) && $_POST['medecin'] == $medecin->getIdMedecin()){
                                        echo 'selected';
                                    }
                                    echo ">".$medecin->getNom()." ".$medecin->getPrenom()."</option>";
                                }
                            ?>
                        </select>
                        <button type="submit">Trier</button>
                    </form>
                </div>
                <div class="bouton-add">
                    <form action="addRDV.php">
                        <button><strong>Ajouter un RDV</strong></button>
                    </form>
                </div>
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
                    if(!isset($_POST['medecin'])){
                        $_POST['medecin'] = 'null';
                    }

                    if($_POST['medecin'] != 'null'){
                        $resultat = serviceRendezVous::getService()->getAllOfM($_POST['medecin']);
                    } else {
                        if($_POST['tri'] == 'nonChronological'){
                            $resultat = serviceRendezVous::getService()->getRDVChronological();
                            $tri = 'chronological';
                        } else {
                            // Si null est sélectionné et qu'on clique sur trier, rien ne se passe
                            $resultat = serviceRendezVous::getService()->getRDVNonChronological();
                            $tri = 'nonChronological';
                        }
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
                                            <button class="bouton-mod" type="submit"><strong>Modifier</strong></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="traitementDeleteRDV.php" method="post">
                                            <input type="hidden" name="idC" value="'.$row->getIdClient().'">
                                            <input type="hidden" name="idM" value="'.$row->getIdMedecin().'">
                                            <input type="hidden" name="DateEtHeure" value="'.$row->getDateEtHeure()->format('Y-m-d H:i').'">
                                            <button class="bouton-del" type="submit"><strong>Supprimer</strong></button>
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
