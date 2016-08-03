<?php

/*
 * Copyright 2016 johanv.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace deceder\resources;

/**
 * Default resources file.
 *
 * @author johanv
 */
class Def {
  static $inschrijfmailSubject = 'Bevestiging inschrijving nieuwsbrief %1$s';
  static $uitschrijfmailSubject = 'U werd uitgeschreven voor de nieuwsbrief van %1$s';
  static $inschrijfmailBody = 'Beste %1$s %2$s,

Bedankt om in te schrijven voor de nieuwsbrief van %5$s.
Om de inschrijving te bevestigen klikt u op onderstaande link:
%4$s/bevestigen?info=%3$s
';
  static $uitschrijfmailBody = 'Beste %1$s %2$s,

Uw e-mailadres %5$s werd verwijderd van de nieuwsbrief. Als het niet uw
bedoeling was om uit te schrijven, kunt u opnieuw inschrijven door op
onderstaande link te klikken:
%4$s/bevestigen?info=%3$s';  
  static $nieuwsbrieftitel = 'nieuwsbrief %1$s %2$s';
  static $nieuwsbriefmail = 'Beste [VOORNAAM] [NAAM],

Het document in bijlage is de recentste nieuwsbrief van %1$s. U kunt deze
en oudere nieuwsbrieven ook downloaden van onze website:
[NIEUWSBRIEVENLINK].

Als u de nieuwsbrief niet meer wilt ontvangen, dan kunt u zich uitschrijven
via onderstaande link:
[UITSCHRIJFLINK].

Met vriendelijke groeten,
%1$s.';
}