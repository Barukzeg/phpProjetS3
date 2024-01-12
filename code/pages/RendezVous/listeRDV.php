<!DOCTYPE HTML>
<html>
    <!--
        Page qui affiche la liste des rendez-vous, ordre changeable en cliquant sur Date
        possède aussi un système de filtre par médecin
    -->
    <!-- vérification si l'utilisateur est connecté -->
    <?php require_once "../Login/verif.php"; ?>

    <head>
        <title>Liste des usagers</title>
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/styleEDT.css">
    </head>

    <!-- header -->
    <?php include_once "../header.php"; ?>

    <body>

        <!-- page -->
        <div class="content">
            <h1>Liste des rendez-vous :</h1>

            <!-- zone du haut de page -->
            <div class="top">
                <div class="menu-deroulant">

                    <!-- menu déroulant de filtre par medecin -->
                    <form action="listeRDV.php" method="post">
                        <label for="medecin">Trier par médecin :</label>
                        <select id="medecin" name="medecin">

                            <!-- option par défaut / sélectionnée si aucun filtre n'est appliqué (autre que lui même) -->
                            <option value="null"
                            <?php
                                if(!isset($_POST['medecin']) || $_POST['medecin'] == 'null'){
                                    echo 'selected';
                                }
                            ?>
                            >-- médecin --</option>

                            <!-- options de filtre (liste des medecins) -->
                            <?php
                                include_once "../../services/serviceMedecin.php";
                                $medecins = serviceMedecin::getService()->getMedecinAlpha();
                                foreach ($medecins as $medecin) {
                                    echo "<option value='".$medecin->getIdMedecin()."' ";
                                    //si le medecin est sélectionné en tant que filtre, on le sélectionne ici aussi
                                    if (isset($_POST['medecin']) && $_POST['medecin'] == $medecin->getIdMedecin()){
                                        echo 'selected';
                                    }
                                    echo ">".$medecin->getNom()." ".$medecin->getPrenom()."</option>";
                                }
                            ?>
                        </select>

                        <!-- bouton pour appliquer le filtre -->
                        <button type="submit">Trier</button>
                    </form>
                </div>

                <!-- bouton pour ajouter un rendez-vous -->
                <div class="bouton-add">
                    <form action="addRDV.php">
                        <button><strong>Ajouter un RDV</strong></button>
                    </form>
                </div>
            </div>

            <!-- affichage des rendez-vous -->
            <?php
                include_once "../../services/serviceRendezVous.php";
                include_once "../../services/serviceUsager.php";
                include_once "../../services/serviceMedecin.php";
                include_once "../../modele/Usager.php";

                try{

                    // si la page est chargée pour la première fois, on met le tri par défaut
                    if(!isset($_POST['tri'])){
                        $tri = $_POST['tri'] = 'chronological';
                    }

                    // si aucun filtre n'est appliqué, on met le filtre par défaut (null)
                    if(!isset($_POST['medecin'])){
                        $_POST['medecin'] = 'null';
                    }

                    // affichage des rendez-vous selon le filtre appliqué
                    if($_POST['medecin'] != 'null'){
                        $resultat = serviceRendezVous::getService()->getAllOfM($_POST['medecin']);
                    } else {

                        // affichage des rendez-vous si aucun filtre n'est appliqué
                        //(switch entre chronologique décroissant, et chronologique croissant des futurs rdv)
                        if($_POST['tri'] == 'nonChronological'){
                            $resultat = serviceRendezVous::getService()->getRDVChronological();
                            $tri = 'chronological';
                        } else {
                            $resultat = serviceRendezVous::getService()->getRDVNonChronological();
                            $tri = 'nonChronological';
                        }
                    }

                    // affichage des rendez-vous
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
                                $minuteEtHeure = $row->getDureeMinutes();
                                $heure = floor($minuteEtHeure / 60);
                                $minute = $minuteEtHeure % 60;
                                echo '
                                <tr>
                                    <td>'.$row->getDateEtHeure()->format('d/m/Y').'</td>
                                    <td>'.$row->getDateEtHeure()->format('H:i').'</td>
                                    <td>';
                                    if ($heure > 0){
                                        echo $heure.'h';
                                        if ($minute > 0){
                                            if ($minute < 10){
                                                echo '0';
                                            }
                                            echo $minute;
                                        }
                                    } else {
                                        echo $minute.' min';
                                    }
                                    echo'</td>
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
                    header('Location: ../erreur.php');
                    exit();
                }
            ?>
        </div>
    </body>
</html>
