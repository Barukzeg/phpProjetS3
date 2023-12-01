Create Table Personne(
    idPersonne int,
    nom varchar(50),
    prenom varchar(50),
    civilite char(2),
    constraint pk_idPerson primary key(idPersonne)
);

Create Table Medecin (
    idMedecin int,
    constraint pk_idMedecin primary key(idMedecin),
    constraint fk_medecinPersonne foreign key(idMedecin) references Personne(idPersonne)
);

Create Table Usager (
    idUsager int,
    idReferent int not null unique,
    adresseComplete varchar(50),
    codePostal decimal(5,0),
    dateNaissance date,
    lieuNaissance varchar(58),
    NumSecuriteSociale decimal(15,0),
    constraint pk_idUser primary key(idUsager),
    constraint fk_userPersonne foreign key(idUsager) references Personne(idPersonne),
    constraint fk_medecinReferent foreign key(idReferent) references Medecin(idMedecin),
    constraint ck_id_ref_diff_id_user check(idUsager != idReferent)
);

Create Table RendezVous(
    idMedecin int,
    idClient int,
    DateEtHeure date,
    DureeEnMinutes int,
    constraint pk_medecinClient primary key (idMedecin, idClient),
    constraint fk_medecin foreign key (idMedecin) references Medecin(idMedecin),
    constraint fk_clientUser foreign key (idClient) references Usager(idUsager)
);
