-- Maak lege database aan.

-- De lengte van de velden is gewoon gegokt, maar ik wou een lokale werkende
-- versie.

-- De tabel 'nieuwsbrief' bevat eigenlijk inschrijvingen en user-informatie.
-- Dat is een erfenis van het verleden.

CREATE TABLE IF NOT EXISTS nieuwsbrief(
    ID INT NOT NULL AUTO_INCREMENT,
    voornaam VARCHAR(50),
    naam VARCHAR(50),
    relatie INT,
    oudervan VARCHAR(200),
    mailadres VARCHAR(50),
    actief INT,
    dt_inschr DATETIME,
    dt_actief DATETIME,
    dt_uitschr DATETIME,
    controle VARCHAR(200),
    PRIMARY KEY(ID)
);

    CREATE TABLE IF NOT EXISTS editie(
        ID INT NOT NULL AUTO_INCREMENT,
        titel VARCHAR(200),
        uploaddatum DATETIME,
        verzendingsdatum DATETIME,
        bestandsnaam VARCHAR(200),
        begeleidendeTekst VARCHAR(20000),
        PRIMARY KEY(ID)
    );