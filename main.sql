-- Oppretter databasen 'vaksineteam'
CREATE DATABASE IF NOT EXISTS vaksineteam;

-- Bruker databasen 'vaksineteam'
USE vaksineteam;

-- Oppretter tabellen 'brukerdata'
CREATE TABLE IF NOT EXISTS brukerdata (
    brukerId INT PRIMARY KEY,
    navn VARCHAR(255),
    etternavn VARCHAR(255),
    telefon VARCHAR(8)
);

-- Oppretter tabellen 'ansatte'
CREATE TABLE IF NOT EXISTS ansatte (
    ansattId INT AUTO_INCREMENT PRIMARY KEY,
    navn VARCHAR(255),
    rolle VARCHAR(255),
    telefon VARCHAR(8)
);

-- Oppretter tabellen 'avtale'
CREATE TABLE IF NOT EXISTS avtale (
    avtId INT AUTO_INCREMENT PRIMARY KEY,
    brukerId INT,
    dato DATE,
    tid TIME,
    lokasjon VARCHAR(255),
    FOREIGN KEY (brukerId) REFERENCES brukerdata(brukerId)
);

-- Oppretter tabellen 'vaksinerte'
CREATE TABLE IF NOT EXISTS vaksinerte (
    vaksineId INT AUTO_INCREMENT PRIMARY KEY,
    brukerId INT,
    ansattId INT,
    lokasjon VARCHAR(255),
    tid TIME,
    dato DATE,
    FOREIGN KEY (brukerId) REFERENCES brukerdata(brukerId),
    FOREIGN KEY (ansattId) REFERENCES ansatte(ansattId)
);
