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

INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(13, 1, '1 Rue du Capitole', '31000', '1967-05-22', 'Toulouse', '131670519283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(14, 2, '2 Avenue des Minimes', '31400', '1978-09-14', 'Toulouse', '131780919283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(15, 3, '3 Rue de la Dalbade', '31500', '1985-12-03', 'Toulouse', '131851219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(16, 4, '4 Boulevard Lascrosses', '31100', '2003-07-18', 'Toulouse', '131030719283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(17, 5, '5 Rue Saint-Rome', '31900', '1990-11-26', 'Toulouse', '131901119283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(18, 6, '6 Allée Jean Jaurès', '31700', '1972-02-09', 'Toulouse', '131720219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(19, 7, '7 Rue du Faubourg Bonnefoy', '31400', '1965-08-31', 'Toulouse', '131650819283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(20, 8, '8 Rue des Filatiers', '31300', '2008-04-11', 'Toulouse', '131080419283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(21, 9, '9 Boulevard de Strasbourg', '31100', '1989-06-25', 'Toulouse', '131890619283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(22, 10, '10 Rue de Metz', '31400', '1975-10-14', 'Toulouse', '131751019283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(23, 11, '11 Allée François Verdier', '31300', '1955-03-17', 'Toulouse', '131550319283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(24, 12, '12 Rue de la République', '31300', '1997-01-05', 'Toulouse', '131970119283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(25, 1, '13 Avenue de Grande-Bretagne', '31200', '1982-09-28', 'Toulouse', '131820919283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(26, 2, '14 Rue de la Concorde', '31500', '1968-12-20', 'Toulouse', '131681219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(27, 3, '15 Boulevard de Thibaud', '31700', '2000-06-08', 'Toulouse', '131001219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(28, 4, '16 Rue de la Pomme', '31600', '1973-02-03', 'Toulouse', '131730219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(29, 5, '17 Rue de la Colombette', '31800', '1960-07-19', 'Toulouse', '131600719283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(30, 6, '18 Allée Charles de Fitte', '31000', '1958-11-30', 'Toulouse', '131581119283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(31, 7, '19 Rue des Lois', '31000', '1987-04-23', 'Toulouse', '131870419283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(32, 8, '20 Avenue Camille Pujol', '31100', '1995-08-07', 'Toulouse', '131950819283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(33, 9, '19 Rue des Marchands', '31300', '1962-01-15', 'Toulouse', '231620119283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(34, 10, '18 Boulevard Riquet', '31000', '2010-09-02', 'Toulouse', '231100919283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(35, 11, '17 Rue de la Chaîne', '31800', '1954-05-26', 'Toulouse', '231540519283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(36, 12, '16 Allée de Brienne', '31700', '1992-12-10', 'Toulouse', '231921219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(37, 1, '15 Rue du Taur', '31000', '1979-06-13', 'Toulouse', '231790619283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(38, 2, '14 Avenue Honoré Serres', '31100', '1984-03-07', 'Toulouse', '231840319283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(39, 3, '13 Rue du Pont Guilheméry', '31500', '2005-10-24', 'Toulouse', '231051019283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(40, 4, '12 Quai Saint-Pierre', '31400', '1969-04-16', 'Toulouse', '231690419283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(41, 5, '11 Rue de l''Indépendance', '31600', '1970-09-29', 'Toulouse', '231700919283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(42, 6, '10 Rue des Arts', '31800', '1952-08-11', 'Toulouse', '231520819283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(43, 7, '9 Boulevard Carnot', '31900', '2009-01-28', 'Toulouse', '231090119283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(44, 8, '8 Rue de la Fonderie', '31000', '1998-05-21', 'Toulouse', '231080519283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(45, 9, '7 Allée Paul Sabatier', '31600', '1966-11-02', 'Toulouse', '231661119283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(46, 10, '6 Rue du Colonel Pélissier', '31400', '1977-04-06', 'Toulouse', '231770419283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(47, 11, '5 Avenue de Lyon', '31500', '1956-02-18', 'Toulouse', '231560219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(48, 12, '4 Rue de la Providence', '31300', '1991-07-30', 'Toulouse', '231910719283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(49, 1, '3 Rue du Printemps', '31300', '2001-12-15', 'Toulouse', '231011219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(50, 2, '2 Boulevard de Suisse', '31100', '1964-06-27', 'Toulouse', '231640619283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(51, 3, '1 Rue de la Bourse', '31200', '1971-10-09', 'Toulouse', '231710919283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(52, 4, '42 Avenue de Rangueil', '31400', '1986-08-04', 'Toulouse', '231860819283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(53, 5, '43 Rue des Blanchers', '31400', '1953-03-22', 'Toulouse', '031530319283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(54, 6, '44 Rue des Tourneurs', '31000', '2011-03-12', 'Toulouse', '031110319283746');
Insert Into Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) Values(55, 10, '48 Rue de la Concorde', '31500', '2004-12-23', 'Toulouse', '031041219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(56, 8, '46 Rue du Rempart Villeneuve', '31000', '1993-02-23', 'Toulouse', '031930219283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(57, 9, '47 Allée Marc Saint-Saëns', '31600', '1959-09-05', 'Toulouse', '031590919283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(58, 10, '48 Rue de la Concorde', '31500', '2007-05-19', 'Toulouse', '031070519283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(59, 11, '22 Rue des Doctrinaires', '31500', '1961-04-14', 'Toulouse', '031610419283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(60, 12, '23 Avenue de la Gloire', '31600', '1976-07-02', 'Toulouse', '031760719283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(61, 1, '24 Rue des Lois', '31000', '1980-10-16', 'Toulouse', '031801019283746');
INSERT INTO Usager(idUsager, idReferent, adresseComplete, codePostal, dateNaissance, lieuNaissance, numSecuriteSociale) VALUES(62, 2, '25 Rue des Potiers', '31100', '1996-04-01', 'Toulouse', '031960419283746');

INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 13, '2024-04-15 09:00:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 14, '2024-03-02 10:30:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 15, '2024-05-23 11:45:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 16, '2024-01-19 12:00:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 17, '2024-06-07 13:15:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 18, '2024-02-29 14:30:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 19, '2024-05-10 15:45:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 20, '2024-03-18 08:00:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 21, '2024-01-31 08:15:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 22, '2024-05-06 08:30:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 23, '2024-06-27 08:45:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 24, '2023-12-08 09:00:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 25, '2024-04-07 09:15:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 26, '2024-01-16 09:30:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 27, '2024-06-21 09:45:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 28, '2024-03-12 10:00:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 29, '2024-05-02 10:15:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 30, '2024-02-09 10:30:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 31, '2024-06-16 10:45:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 32, '2024-03-25 11:00:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 33, '2024-01-07 11:15:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 34, '2024-05-17 11:30:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 35, '2023-11-11 11:45:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 36, '2024-02-22 12:00:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 37, '2024-06-01 12:15:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 38, '2024-03-08 12:30:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 39, '2024-05-29 12:45:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 40, '2024-01-24 13:00:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 41, '2024-04-21 13:15:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 42, '2024-02-15 13:30:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 43, '2024-06-26 13:45:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 44, '2024-03-16 14:00:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 45, '2024-05-07 14:15:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 46, '2024-01-04 14:30:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 47, '2024-06-20 14:45:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 48, '2024-02-05 08:00:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 49, '2024-04-26 08:15:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 50, '2024-01-13 08:30:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 51, '2024-05-12 08:45:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 52, '2024-03-01 09:00:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 53, '2024-06-10 09:15:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 54, '2024-02-26 09:30:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 55, '2024-05-21 09:45:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 56, '2023-11-20 10:00:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 57, '2024-03-29 10:15:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 58, '2024-01-22 10:30:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 59, '2024-06-04 10:45:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 60, '2024-04-12 11:00:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 61, '2024-02-01 11:15:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 62, '2024-05-15 11:30:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 13, '2024-03-06 12:00:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 14, '2024-01-28 12:15:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 15, '2024-06-25 12:30:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 16, '2024-04-03 12:45:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 17, '2024-02-19 13:00:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 18, '2024-05-04 13:15:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 19, '2023-12-15 13:30:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 20, '2024-03-21 13:45:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 21, '2024-01-10 14:00:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 22, '2024-06-14 14:15:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 23, '2024-04-28 14:30:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 24, '2024-02-11 14:45:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 25, '2024-05-19 15:00:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 26, '2023-11-07 15:15:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 27, '2024-03-14 15:30:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 28, '2024-01-01 15:45:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 29, '2024-06-23 16:00:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 30, '2024-04-10 16:15:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 31, '2024-02-03 16:30:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 32, '2024-05-14 16:45:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 33, '2023-12-01 08:00:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 34, '2024-03-04 08:15:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 35, '2024-06-08 08:30:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 36, '2024-04-17 08:45:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 37, '2024-02-08 09:00:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 38, '2024-05-28 09:15:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 39, '2023-11-15 09:30:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 40, '2024-03-27 09:45:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 41, '2024-01-19 10:00:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 42, '2024-06-02 10:15:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 43, '2024-04-05 10:30:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 44, '2024-02-24 10:45:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 45, '2024-05-10 11:00:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 46, '2023-11-24 11:15:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 47, '2024-03-10 11:30:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 48, '2024-01-31 11:45:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 49, '2024-06-19 12:00:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 50, '2024-04-14 12:15:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 51, '2024-02-05 12:30:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(4, 52, '2024-05-06 12:45:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(5, 53, '2023-12-11 13:00:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(6, 54, '2024-03-02 13:15:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(7, 55, '2024-01-16 13:30:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(8, 56, '2024-06-22 13:45:00', 75);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(9, 57, '2024-04-02 14:00:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(10, 58, '2024-02-17 14:15:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(11, 59, '2024-05-01 14:30:00', 120);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(12, 60, '2023-11-18 14:45:00', 30);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 61, '2024-03-23 15:00:00', 45);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 62, '2024-01-04 15:15:00', 60);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(1, 13, '2024-04-30 15:45:00', 90);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(2, 14, '2024-02-13 16:00:00', 105);
INSERT INTO RendezVous(idMedecin, idClient, dateEtHeure, dureeEnMinutes) VALUES(3, 15, '2024-05-24 16:15:00', 120);