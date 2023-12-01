<!DOCTYPE HTML>
<html>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <body>
        <div>
            <h1>Saisie :</h1>
            <form action="ajoutcontact.php" method="post">
                Nom : <input type="text" name="nom"><br>
                Prenom : <input type="text" name="prenom"><br>
                Adresse : <input type="text" name="adresse"><br>
                Code postal : <input type="text" name="codepostal"><br>
                Ville : <input type="text" name="ville"><br>
                Numero de tel : <input type="tel" name="numerotel"><br>
                <input type="reset" name="reset" value="Reset">
                <input type="submit" name="envoie" value="Envoyer">
            </form>   
        </div>
    </body>
</html>