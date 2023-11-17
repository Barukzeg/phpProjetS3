--Create Table

Create Table Personne(
    idPersonne counter,
    nom varchar2(50),
    civilite char(2),
    primary key(idPersonne)
);

Create Table Medecin (
    idMedecin int not null,
    primary key(idMedecin),
    foreign key(idMedecin) references Personne(idPersonne)
);

Create Table Usager (
    idUsager int,
    idReferent int not null unique,
    adresseComplete varchar2(50),
    codePostal number(5),
    dateNaissance date,
    lieuNaissance varchar2(58),
    NumSecuriteSociale number(15)
    primary key(idUsager),
    foreign key(idUsager) references Personne(idPersonne),
    foreign key(idReferent) references Medecin(idMedecin),
    constraint ck_id-ref_diff_id-user check(idUsager != idReferent)
);

Create Table RendezVous(
    idMedecin int,
    idClient int,
    DateEtHeure date,
    DureeEnMinutes int,
    primary key (idMedecin, idClient),
    foreign key (idMedecin) references Medecin(idMedecin),
    foreign key (idClient) references Usager(idUsager)
);
