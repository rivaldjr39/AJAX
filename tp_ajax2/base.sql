create table emp_membre(
    id_membre  int auto_increment primary key,
    nom varchar(50),
    email varchar(100),
    pwd varchar(255)
);

insert into membre (nom, email, pwd) values
('Alice Dupont', 'alice@gmail.com', '12345'),
('Bob Martin', 'bob@gmail.com', 'pass'),
('Charlie Durand', 'charlie@gamail.com', 'qwerty'); 


create table emp_publication (
    id_publication int auto_increment primary key;
    texte varchar(1000),
    id_membre int,
    FOREIGN KEY (id_membre) REFERENCES emp_membre(id_membre);

);
 create table emp_commentaire(
    id_commentaire int auto_increment primary key;
    id_publication int
    foreign key (id_publication) REFERENCES emp_publication(id_publication),
    id_membre int ,
    FOREIGN KEY (id_membre) REFERENCES emp_membre(id_membre)
);
