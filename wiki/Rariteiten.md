# Rariteiten

Er zitten wel wat rariteiten in dit project. Sommige hebben een geschiedenis, andere zijn gewoon een gevolg van mijn beperkte ervaring met objectgeörienteerde PHP.

Ten eerste is het in het Nederlands. Dat komt omdat het gebruikt wordt door een Nederlandstalige organisatie. Een school dus, zoals je wel zult merken als je de toepassing installeert. Dit project heeft niet de ambitie om overal ter wereld gebruikt te worden, maar wie wil vertalen, mag.

De vragen op de inschrijvingspagina zijn dus erg schoolgebonden. Een systeem van vrije velden zou cool zijn, maar dat is er dus nog niet. Als je die extra velden niet nodig hebt, kun je altijd `deceder/view/inschrijven.php` aanpassen.

Ik include te pas en te onpas `configuration.php`, als ik settings nodig heb. Dat moet beter kunnen. Bijvoorbeeld een apart singleton maken dat de settings oplevert.

Er zijn veel files met dezelfde naam. Dat had ik misschien beter niet gedaan. Nu is het soms lastig om de juiste file te vinden als je er X aantal open hebt staan in je IDE.

Ik gebruik wel namespaces, maar geen `using`, waardoor de code wat overladen is. Dat zou ik eigenlijk eens moeten opkuisen.

Ik gebruik geen bestaande libraries. In eerste instantie wou ik zelf zo veel mogelijk uitproberen. Maar een library'tje om mails te sturen zou bijvoorbeeld al niet slecht zijn. Of een templating engine voor de views. En misschien moet ik ooit eens een echt framework voor MVC gebruiken.
