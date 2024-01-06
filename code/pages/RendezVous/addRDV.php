<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleForm.css"/>
    <body>
        <div>
            <form action="traitementAddRDV.php" method="post">
                <label for="usager">Usager :</label>
                <select id="usager" name="usager" required>
                    <?php
                        include_once "../../services/serviceUsager.php";
                        $usagers = serviceUsager::getService()->getUsagerAlpha();
                        foreach ($usagers as $usager) {
                            echo "<option value='".$usager->getIdUsager()."'>".$usager->getNom()." ".$usager->getPrenom()."</option>";
                        }
                    ?>
                </select>

                <label for="medecin">Medecin :</label>
                <select id="medecin" name="medecin" required>
                    <?php
                        include_once "../../services/serviceMedecin.php";
                        $medecins = serviceMedecin::getService()->getMedecinAlpha();
                        foreach ($medecins as $medecin) {
                            echo "<option value='".$medecin->getIdMedecin()."'>".$medecin->getNom()." ".$medecin->getPrenom()."</option>";
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