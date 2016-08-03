<?php

// Pas deze variabelen aan voor je eigen installatie, en noem de
// file configuration.php. Dan zou het moeten werken.


// De bedoeling is dat deze file geimporteerd wordt waar ze nodig is, en
// dat ze niet opgenomen wordt in de source repository.
// Op die manier moeten er geen credentials in de echte source zitten.

// TODO: properdere oplossing zoeken die kans op name clashes verkleint.

$DE_SQL_USER = 'gebruikersnaam_mysql_db';
$HET_SQL_WACHTWOORD = 'wachtwoord_mysql_db';
$DE_SQL_DATABASE = 'databasenaam_mysql_db';

// Het wachtwoord voor het versturen van de nieuwsbrief.
// Maak dit moeilijk genoeg, en zorg ervoor dat het niet lekt!
$AUTHORIZATION_KEY = "tahPheifoojaiweu0she";

$ORGANIZATION_NAME = 'Naam van je organisatie (school)';
$MAIL_FROM = 'Afzender <afzender@example.com>';

// $MAIL_BCC Is optioneel:
//$MAIL_BCC = 'bcc-adres@example.com';
// limiet grootte pdf (in bytes):
$MAX_FILE_SIZE = 200000;

// Urls van de nieuwsbrief en de basissite
// Omdat we met een wachtwoord werken, gebruik je best
// https.
$NIEUWSBRIEF_BASE = 'https://example.org/nieuwsbrief';
$WEBSITE_BASE = 'https://example.org';

// Pad waar de pdf-bijlagen worden bewaard.
// De server moet hier kunnen schrijven.
$FILE_ARCHIVE = '/path/to/nieuwsbrief/archief';
