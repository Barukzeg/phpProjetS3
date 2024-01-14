Drop Table RendezVous;
Drop Table Usager;
Drop Table Medecin;
Drop Table Personne;
Drop Table Identifiants;

Create Table Personne(
    idPersonne int auto_increment,
    nom varchar(50),
    prenom varchar(50),
    civilite char,
    constraint pk_idPerson primary key(idPersonne)
);

Create Table Medecin (
    idMedecin int,
    constraint pk_idMedecin primary key(idMedecin),
    constraint fk_medecinPersonne foreign key(idMedecin) references Personne(idPersonne)
);

Create Table Usager (
    idUsager int,
    idReferent int null,
    adresseComplete varchar(50),
    codePostal char(5) default '00000',
    dateNaissance date,
    lieuNaissance varchar(58),
    numSecuriteSociale char(15) unique default '000000000000000',
    constraint pk_idUser primary key(idUsager),
    constraint fk_userPersonne foreign key(idUsager) references Personne(idPersonne),
    constraint fk_medecinReferent foreign key(idReferent) references Medecin(idMedecin),
    constraint ck_id_ref_diff_id_user check(idUsager != idReferent)
);

Create Table RendezVous(
    idMedecin int,
    idClient int,
    dateEtHeure datetime,
    dureeEnMinutes int,
    constraint pk_medecinClient primary key (idMedecin, idClient, DateEtHeure),
    constraint fk_medecin foreign key (idMedecin) references Medecin(idMedecin),
    constraint fk_clientUser foreign key (idClient) references Usager(idUsager)
);

Create Table Identifiants(
    login varchar(50),
    mdp varchar(50),
    constraint pk_login primary key(login)
);

Insert Into Identifiants(login, mdp) Values('admin', 'password');
Insert Into Identifiants(login, mdp) Values('secretariat', 'motdepassedusecretariat');

Insert Into Personne(nom, prenom, civilite) Values('Duval', 'Jules', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Denis', 'Nicolas', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Dumont', 'Raphaël', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Marie', 'Yanis', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Lemaire', 'Valentin', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Noel', 'Pauline', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Meyer', 'Romane', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Dufour', 'Juliette', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Menier', 'Zoé', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Brun', 'Lilou', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Blanchard', 'George', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Giraud', 'Cali', 'X');

Insert Into Personne(nom, prenom, civilite) Values('Martin', 'Lucas', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Bernard', 'Enzo', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Thomas', 'Thomas', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Petit', 'Théo', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Robert', 'Hugo', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Richard', 'Nathan', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Durand', 'Maxime', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Dubois', 'Mathis', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Moreau', 'Louis', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Laurent', 'Clément', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Simon', 'Alexendre', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Michel', 'Antoine', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Lefebre', 'Tom', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Leroy', 'Léo', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Roux', 'Alexis', 'M');
Insert Into Personne(nom, prenom, civilite) Values('David', 'Quentin', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Bertrand', 'Arthur', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Maurel', 'Paul', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Fournier', 'Baptiste', 'M');
Insert Into Personne(nom, prenom, civilite) Values('Girard', 'Romain', 'M');

Insert Into Personne(nom, prenom, civilite) Values('Bonnet', 'Léa', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Dupont', 'Emma', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Lambert', 'Manon', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Fontaine', 'Chloé', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Rousseau', 'Camille', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Vincent', 'Clara', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Muller', 'Sarah', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Lefevre', 'Noëmie', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Faure', 'Jade', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Andre', 'Océane', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Mercier', 'Marie', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Blanc', 'Lucie', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Guerin', 'Anaïs', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Boyer', 'Lola', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Chevalier', 'Eva', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Francois', 'Mathilde', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Legrand', 'Julie', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Gauthier', 'Laura', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Garcia', 'Lisa', 'F');
Insert Into Personne(nom, prenom, civilite) Values('Perrin', 'Louise', 'F');

Insert Into Personne(nom, prenom, civilite) Values('Robin', 'Jackie', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Clement', 'Morgan', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Morin', 'Sam', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Nicolas', 'Claude', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Henry', 'Sasha', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Roussel', 'Alix', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Mathieu', 'Charlie', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Gautier', 'Ange', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Masson', 'Céleste', 'X');
Insert Into Personne(nom, prenom, civilite) Values('Marchand', 'Kim', 'X');

Insert Into Medecin(idMedecin) Values(1);
Insert Into Medecin(idMedecin) Values(2);
Insert Into Medecin(idMedecin) Values(3);
Insert Into Medecin(idMedecin) Values(4);
Insert Into Medecin(idMedecin) Values(5);
Insert Into Medecin(idMedecin) Values(6);
Insert Into Medecin(idMedecin) Values(7);
Insert Into Medecin(idMedecin) Values(8);
Insert Into Medecin(idMedecin) Values(9);
Insert Into Medecin(idMedecin) Values(10);
Insert Into Medecin(idMedecin) Values(11);
Insert Into Medecin(idMedecin) Values(12);

Insert Into Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) Values(13, 1, '1 rue de la paix', '75000', '1990-01-01', 'Paris', '123456789012345');
Insert Into Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) Values(14, 2, '2 rue de la paix', '75000', '1990-01-01', 'Paris', '123456789012345');