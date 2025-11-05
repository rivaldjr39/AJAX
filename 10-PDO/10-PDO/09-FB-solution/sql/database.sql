CREATE DATABASE FB;

USE FB;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    motdepasse VARCHAR(255) NOT NULL
);

CREATE TABLE publications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publication TEXT NOT NULL,
    auteur VARCHAR(50) NOT NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commentaire TEXT NOT NULL,
    auteur VARCHAR(50) NOT NULL,
    publication_id INT,
    date_commentaire TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur) REFERENCES utilisateurs(login),
    FOREIGN KEY (publication_id) REFERENCES publications(id)
);