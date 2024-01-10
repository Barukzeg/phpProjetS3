<!DOCTYPE HTML>
<html>
    <?php require_once "../Login/verif.php"; ?>
    <link rel="icon" type="image/png" href="/phpProjetS3/code/image/logo.ico"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleForm.css"/>
    <?php
        include_once "../../services/serviceUsager.php";
        $user = serviceUsager::getService()->get($_POST['idUsager']);
    ?>
    <body>
        <div>
            <form action="traitementModUsager.php" method="post">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $user->getNom(); ?>" required>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $user->getPrenom(); ?>" required>

                <label for="civilite">Civilité :</label>
                <select id="civilite" name="civilite" required>
                    <option value="M" <?php
                        if ($user->getCivilite() == 'M'){
                            echo 'selected';
                        }
                    ?>>M</option>
                    <option value="F" <?php
                        if ($user->getCivilite() == 'F'){
                            echo 'selected';
                        }
                    ?>>F</option>
                    <option value="X" <?php
                        if ($user->getCivilite() == 'X'){
                            echo 'selected';
                        }
                    ?>>Autre/Ne se prononce pas</option>
                </select>

                <label for="medecinRef">Medecin référent</label>
                <select id="medecinRef" name="medecinRef" required>
                    <option value="null">Pas de medecin référent</option>
                    <?php
                        include_once "../../services/serviceMedecin.php";
                        $medecins = serviceMedecin::getService()->getMedecinAlpha();
                        foreach ($medecins as $medecin) {

                            $isMedecinRef = '';
                            if ($medecin->getIdMedecin() == $user->getidReferent()) {
                                $isMedecinRef = ' selected';
                            }
                            echo "<option value='".$medecin->getIdMedecin()."' ".$isMedecinRef.">".$medecin->getNom()." ".$medecin->getPrenom()."</option>";
                        }
                    ?>
                </select>

                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $user->getAdresseComplete(); ?>" required>

                <label for="codepostal">Code postal :</label>
                <input type="text" id="codepostal" name="codepostal" value="<?php echo $user->getCodePostal(); ?>" required>

                <label for="dateNaissance">Date de naissance :</label>
                <input type="date" id="dateNaissance" name="dateNaissance" value="<?php echo $user->getDateNaissance()->format('Y-m-d'); ?>" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" required>

                <label for="villeNaissance">Ville de naissance :</label>
                <input type="text" id="villeNaissance" name="villeNaissance" value="<?php echo $user->getLieuNaissance(); ?>" required>

                <label for="numSecu">Numéro de sécurité sociale :</label>
                <input type="text" id="numSecu" name="numSecu" pattern="\d{15}" value="<?php echo $user->getNumSecuriteSociale(); ?>" required>

                <input type="hidden" name="idUsager" value="<?php echo $user->getIdUsager(); ?>">

                <div class="btn-container">
                    <button type="submit">Valider</button>
                    <button type="reset">Réinitialiser</button>
                    <button type="button" onclick="history.back()">Retour</button>
                </div>
            </form>
        </div>
    </body>
</html>