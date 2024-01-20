<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
        <title>Ajout RDV</title>
    </head>
    <?php require_once "../Login/verif.php"; ?>
    <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleForm.css"/>
    <body>
        <div class="centered-container">
            <form action="traitementAddRDV.php" method="post">

                <input type="hidden" id="usager" name="usager" value="<?php echo $_POST['usager']; ?>" required>

                <label for="medecin">Medecin :</label>
                <select id="medecin" name="medecin" required>
                    <?php
                        include_once "../../services/serviceMedecin.php";
                        include_once "../../services/serviceUsager.php";
                        $medecins = serviceMedecin::getService()->getMedecinAlpha();
                        foreach ($medecins as $medecin) {
                            echo "<option value='".$medecin->getIdMedecin()."'";
                            if ($medecin->getIdMedecin() == serviceUsager::getService()->get($_POST['usager'])->getIdReferent()){
                                echo " selected";
                            } 
                            echo ">".$medecin->getNom()." ".$medecin->getPrenom()."</option>";
                        }
                    ?>
                </select>

                <label for="dateRDV">Date :</label>
                <input type="date" id="dateRDV" name="dateRDV" min="<?php echo date('Y-m-d'); ?>" max="2149-12-31" required>

                <label for="heureRDV">Heure :</label>
                <input type="time" id="heureRDV" name="heureRDV" min="08:00" max="18:00" required>

                <label for="dureeRDV">Durée :</label>
                <input type="number" id="dureeRDV" name="dureeRDV" min="10" max="120" value="30" required>

                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Réinitialiser</button>
                    <button type="button" onclick="history.back()">Retour</button>
                </div>
            </form>
        </div>
    </body>
</html>