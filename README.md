# Vaksineregistrering
Oppgave I utviklingsfaget med databaser


SQL Tabeller:

Avtaler:
avtId (STRING)
brukerId (STRING)
lokasjon (STRING)
tid (TIME)
dato (DATE)

Brukerdata:
navn (STRING)
etternavn (STRING)
tlf (INT)
mail (STRING)
adresse (STRING)
postnr (INT)

create table avtale(
	avtId int AUTO_INCREMENT,
    brukerId int,
    dato date,
    tid time,
    lokasjon varchar(1),
    PRIMARY KEY (avtId),
    FOREIGN KEY (brukerId) REFERENCES brukerdata (brukerId)
);

