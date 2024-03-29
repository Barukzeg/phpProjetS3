<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <head>
        <title>Liste des usagers</title>
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <link rel="stylesheet" href="/phpProjetS3/code/style/style.css">
        <link rel="stylesheet" href="/phpProjetS3/code/style/styleListe.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Liste des usagers :</h1>
            <div class="bouton-add">
                <form action="addUsager.php">
                    <button><strong>Ajouter un usager</strong></button>
                </form>
            </div>
            <?php
                include_once "../../services/serviceUsager.php";
                include_once "../../services/serviceMedecin.php";
                include_once "../../modele/Usager.php";

                try{
                    $resultat = serviceUsager::getService()->getUsagerAlpha();
                    echo '<div class="affichageResult">';
                    foreach ($resultat as $row) {
                        switch($row->getCivilite()){
                            case 'M':
                                $sexe = 'Homme';
                                $sexeImg = 'M.png';
                                break;
                            case 'F':
                                $sexe = 'Femme';
                                $sexeImg = 'F.png';
                                break;
                            case 'A':
                                $sexe = 'Autre';
                                $sexeImg = 'X.png';
                                break;
                            default:
                                $sexe = 'Non renseigné';
                                $sexeImg = 'X.png';
                                break;
                        }
                        $photo = "/phpProjetS3/code/image/".$sexeImg;
                        echo '
                        <div class="result">
                            <div class="photo-btn">
                                <div class="photo">
                                    <img src='.$photo.'>
                                </div>
                                <div class="btn-container custom-buttons">
                                    <form action="modUsager.php" method="post">
                                        <input type="hidden" name="idUsager" value="'.$row->getIdUsager().'">
                                        <button class="bouton-form" id="bouton-mod" type="submit"><strong>Modifier</strong></button>
                                    </form>
                                    <br>
                                    <form action="traitementDeleteUsager.php" method="post">
                                        <input type="hidden" name="idUsager" value="'.$row->getIdUsager().'">
                                        <button class="bouton-form" id="bouton-del" type="submit"><strong>Supprimer</strong></button>
                                    </form>
                                </div>
                            </div> 
                            <div class="info">'
                                .$row->getNom().' '
                                .$row->getPrenom().'<br>'
                                .'Sexe : '.$sexe.'<br>'
                                .'Adresse : '.$row->getCodePostal().' '.$row->getAdresseComplete().'<br>'
                                .'Date de naissance : '.$row->getDateNaissance()->format('d/m/Y').'<br>'
                                .'Ville de naissance : '.$row->getLieuNaissance().'<br>'
                                .'Numéro de sécurité sociale : '.$row->getNumSecuriteSociale().'<br>';
                                if($row->getidReferent() != null){
                                    $medecin = serviceMedecin::getService()->get($row->getidReferent());
                                    echo 'Médecin référent : '.$medecin->getNom().' '.$medecin->getPrenom().'<br>';
                                } else {
                                    echo 'Médecin référent : Aucun médecin référent<br>';
                                }
                                echo '
                            </div>
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