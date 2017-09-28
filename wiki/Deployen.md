# Hoe deployen

## Serververeisten:

* php 5.6 (werkt misschien ook met php 5.4, maar dat is niet getest.)
* de server moet de rewrite-truken uit `.htaccess` kunnen toepassen. Als je apache gebruikt, moet je dus mod_rewrite enablen.
* je server moet mails kunnen versturen vanuit php met [mail](https://secure.php.net/manual/en/function.mail.php). Dat wil zeggen dat ook je reverse-dns-dingen in orde moeten zijn. (Ik heb het programma zodanig geschreven dat een andere manier van mailen makkelijk toe te voegen is. Maar die is er nu dus nog niet.)

## Installatie

* Clone of download de code, en pak ze uit op een plaats waar je webserver ze kan serven. Het ding is getest met PHP 5.6. De server moet de rewrite-truken uit `.htaccess` kunnen toepassen, dus als je webserver apache is, dan moet mod_rewrite geënabled zijn.
* Maak een database aan, en run daarin het script `sql/database.sql`.
* Zorg ervoor dat de server een folder heeft om de pdf-bijlagen te bewaren.
* Pas de file `configuration.example.php` aan, en hernoem ze als `configuration.php`. De comments in de file zijn hopelijk duidelijk genoeg, zodat je weet wat je moet doen. Pas zeker `$AUTHORIZATION_KEY` aan!
* Klaar :+1: 
