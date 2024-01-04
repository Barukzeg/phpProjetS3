<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/addUsager.css"/>
    <?php
        include_once "../../services/serviceRendezVous.php";
        $rdv = serviceRendezVous::getService()->get($_POST['idM'], $_POST['idC'], new DateTime($_POST['DateEtHeure']));
    ?>
    <body>
        <div>
            <form action="traitementModRDV.php" method="post">

                <label for="dateRDV">Date :</label>
                <input type="date" id="dateRDV" name="dateRDV" min="<?php echo date('Y-m-d'); ?>" max="2149-12-31" value="<?php echo $rdv->getDateEtHeure()->format('Y-m-d'); ?>" required>

                <label for="heureRDV">Heure :</label>
                <input type="time" id="heureRDV" name="heureRDV" min="08:00" max="18:00" value="<?php echo $rdv->getDateEtHeure()->format('H:i'); ?>" required>

                <label for="dureeRDV">Durée :</label>
                <input type="number" id="dureeRDV" name="dureeRDV" min="10" max="120" value="<?php echo $rdv->getDureeMinutes(); ?>" required>

                <input type="hidden" name="idM" value="<?php echo $rdv->getIdMedecin(); ?>">
                <input type="hidden" name="idC" value="<?php echo $rdv->getIdClient(); ?>">
                <input type="hidden" name="DateEtHeure" value="<?php echo $rdv->getDateEtHeure()->format('Y-m-d H:i'); ?>">

                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Réinitialiser</button>
                    <button type="button" onclick="history.back()">Retour</button>
                </div>
            </form>
        </div>
    </body>
</html>