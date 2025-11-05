create table emp_membre(
    id_membre  int auto_increment primary key,
    nom varchar(50),
    email varchar(100),
    pwd varchar(255)
);

insert into emp_membre (nom, email, pwd) values
('Alice Dupont', 'alice@gmail.com', '12345'),
('Bob Martin', 'bob@gmail.com', 'pass'),
('Charlie Durand', 'charlie@gamail.com', 'qwerty'); 


CREATE TABLE emp_publication (
    id_publication INT AUTO_INCREMENT PRIMARY KEY,
    texte VARCHAR(1000),
    id_membre INT,
    FOREIGN KEY (id_membre) REFERENCES emp_membre(id_membre) ON DELETE CASCADE
);


 

 create table emp_commentaire(
    id_commentaire INT AUTO_INCREMENT PRIMARY KEY,
    texte VARCHAR(1000),
    id_publication int,
    FOREIGN KEY (id_publication) REFERENCES emp_publication(id_publication),
    id_membre INT,
    FOREIGN KEY (id_membre) REFERENCES emp_membre(id_membre)
);
