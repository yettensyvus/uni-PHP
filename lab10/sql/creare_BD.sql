-- Crearea bazei de date
CREATE DATABASE IF NOT EXISTS crafti;
USE crafti;

-- Tabela Filiala_Crafti
CREATE TABLE Filiala_Crafti (
    id_filiala INT AUTO_INCREMENT PRIMARY KEY,
    adresa_filiala VARCHAR(255) NOT NULL,
    nr_telefon_filiala VARCHAR(15) NOT NULL
);

-- Tabela Eveniment
CREATE TABLE Eveniment (
    id_eveniment INT AUTO_INCREMENT PRIMARY KEY,
    denumire_eveniment VARCHAR(100) NOT NULL,
    responsabil_eveniment VARCHAR(100) NOT NULL,
    nr_loc_disponibile INT NOT NULL,
    cost_eveniment DECIMAL(10,2) NOT NULL
);

-- Tabela Filiala_Data_Ora
CREATE TABLE Filiala_Data_Ora (
    id_filiala_data_ora INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    ora TIME NOT NULL,
    id_filiala INT NOT NULL,
    id_eveniment INT NOT NULL,
    FOREIGN KEY (id_filiala) REFERENCES Filiala_Crafti(id_filiala),
    FOREIGN KEY (id_eveniment) REFERENCES Eveniment(id_eveniment)
);

-- Tabela Parinte
CREATE TABLE Parinte (
    id_parinte INT AUTO_INCREMENT PRIMARY KEY,
    prenume_parinte VARCHAR(50) NOT NULL,
    nr_telefon_parinte VARCHAR(15) NOT NULL
);

-- Tabela Copil
CREATE TABLE Copil (
    id_copil INT AUTO_INCREMENT PRIMARY KEY,
    prenume_copil VARCHAR(50) NOT NULL,
    an_nastere_copil INT NOT NULL,
    id_parinte INT NOT NULL,
    FOREIGN KEY (id_parinte) REFERENCES Parinte(id_parinte)
);

-- Tabela Inscriere_Eveniment
CREATE TABLE Inscriere_Eveniment (
    id_inscriere INT AUTO_INCREMENT PRIMARY KEY,
    data_inscriere DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_filiala_data_ora INT NOT NULL,
    id_copil INT NOT NULL,
    FOREIGN KEY (id_filiala_data_ora) REFERENCES Filiala_Data_Ora(id_filiala_data_ora),
    FOREIGN KEY (id_copil) REFERENCES Copil(id_copil)
);

-- Tabela Manager
CREATE TABLE Manager (
    id_manager INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    parola VARCHAR(255) NOT NULL
);
