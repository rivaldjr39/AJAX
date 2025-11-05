create table Personne(
    idPersonne int primary key auto_increment,
    Nom varchar(50),
    Prenom varchar(60),
    AnneeNaissance int
);

insert into Personne (Nom, Prenom, AnneeNaissance) values
('Dupont', 'Jean', 1980),
('Martin', 'Claire', 1990),
('Durand', 'Paul', 1975),
('Bernard', 'Sophie', 1985),
('Petit', 'Luc', 2000);