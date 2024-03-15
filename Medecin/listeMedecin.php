<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <head>
        <title>Liste des medecins</title>
        <link rel="icon" type="image/png" href="../image/logo.ico"/>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/styleListe.css">
    </head>
    <!-- TODO réparer le header
    parce que la ca marche mais c'est chemin absolu
    dcp c'est pas bien -->
    <?php include_once "../header.php"; ?>
    <body>
        <div class="content">
            <h1>Liste des medecins :</h1>
            <div class="bouton-add">
                <form action="addMedecin.php">
                    <button><strong>Ajouter un medecin</strong></button>
                </form>
            </div>
            <?php
                include_once "../services/serviceMedecin.php";
                include_once "../repository/repoMedecin.php";
                include_once "../modele/medecin.php";

                try{
                    $resultat = serviceMedecin::getService()->getMedecinAlpha();
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
                        $photo = "/image/".$sexeImg;
                        echo '
                        <div class="result">
                            <div class="photo-btn">
                                <div class="photo">
                                    <img src='.$photo.'>
                                </div>
                                <div class="btn-container custom-buttons">
                                    <form action="modMedecin.php" method="post">
                                        <input type="hidden" name="idMedecin" value="'.$row->getIdMedecin().'">
                                        <button class="bouton-form" id="bouton-mod" type="submit"><strong>Modifier</strong></button>
                                    </form>
                                    <br>
                                    <form action="traitementDeleteMedecin.php" method="post">
                                        <input type="hidden" name="idMedecin" value="'.$row->getIdMedecin().'">
                                        <button class="bouton-form" id="bouton-del" type="submit"><strong>Supprimer</strong></button>
                                    </form>
                                </div>
                            </div> 
                            <div class="info">'
                                .$row->getNom().' '
                                .$row->getPrenom().'<br>'
                                .'Sexe : '.$sexe.'
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