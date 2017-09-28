Wegwijs in de source code van de nieuwsbrief
============================================

Beknopte wegwijs in de code. Het kan zijn dat ik dingen volledig fout doe. Ik aanvaard pull requests :-)

Teksten
-------

Veel van de teksten die de toepassing toont, kun je aanpassen in
`nieuwsbrief/deceder/resources/def.php`.

Commando’s
----------

In `nieuwsbrief/deceder/command` vind je alle commando's
die de nieuwsbrief begrijpt. In elke file zie je welke permissies je
nodig hebt om de commando's uit te voeren, en welke actie uitgevoerd
wordt. Uiteindelijk wordt een resultaat opgeleverd, en dat is ofwel een
view, ofwel een redirect, ofwel een download.

Permissies
----------

Alle beschikbare permissies zijn gedefinieerd in
`nieuwsbrief/deceder/authorization/permissions.php`.
Permissies krijg je omdat je een rol hebt. Een rol krijg je van een
'RoleProvider', er zijn er voorlopig 2.

-   De 'UserKeyRoleProvider'
    (`nieuwsbrief/deceder/authorization/userkeyroleprovider.php`)
    geeft je de rol 'aangemeld' als je op de site komt door op een
    link uit de mail te klikken.
-   De 'ConfigKeyRoleProvider'
    (`nieuwsbrief/deceder/authorization/configkeyroleprovider.php`)
    geeft je de rol 'admin' als je het wachtwoord uit het
    configuratiebestand hebt ingegeven.

Views
-----

Bekijk bijvoorbeeld even de code in
`nieuwsbrief/deceder/command/inschrijven.php`. Je ziet dat
dit commando een `ViewResult` oplevert. Zo’n `ViewResult` construeer je
met 3 parameters:

-   het model, de data die getoond zal worden door de view.
-   een array met errors (optioneel).
-   de naam van de view (optioneel). Als die ontbreekt wordt de view
    getoond met dezelfde naam als het commando.

De views zelf staan in `nieuwsbrief/deceder/view`. Dat zijn
php-bestanden die eigenlijk enkel informatie mogen tonen. Die informatie
wordt geacht in het object `$model` te zitten. Als je er eens eentje
bekijkt (bijv. `nieuwsbrief/deceder/view/bevestigen.php`)
wordt het misschien duidelijker.

Het algemene 'thema' van de site, waarin elke view aan vastgeplakt wordt, staat
in `nieuwsbrief/deceder/view/bevestigen.php`.

Het systeem van de views is erg basic, en kan zeker verbeterd worden.

Logica
------

Het 'echte werk' van de toepassing gebeurt in statische klasses in
`nieuwsbrief/deceder/logic`.

Testability
-----------

Ik heb nog geen unit tests, maar ik heb al wel geprobeerd om het project
testable te maken. Databasetoegang, het versturen van e-mail en het
bewaren van pdf-bijlages wordt geregeld door abstracte classes. Die
abstracte klasses geven ook toegang tot 1 concrete instance die gebruikt
wordt voor het echte werk. Zie

-   `nieuwsbrief/deceder/data/data.php`
-   `nieuwsbrief/deceder/external/mailer.php`
-   `nieuwsbrief/deceder/external/filestorage.php`
