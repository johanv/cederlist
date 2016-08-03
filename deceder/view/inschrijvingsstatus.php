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
?>

<h1>Inschrijvingsstatus</h1>

<?php
switch ($model->actief) {
  case 1:
?>

<?=$model->voornaam?> <?=$model->naam?> (<?=$model->mailadres?>)
is ingeschreven voor de nieuwsbrief.

<?php
    break;
  case 0:
?>

<p>
We stuurden een e-mail naar <?=$model->mailadres?>, met daarin een link om
de inschrijving te bevestigen. Van zodra de inschrijving bevestigd is, zult
u de nieuwsbrief op dit e-mailadres ontvangen.
</p>

<p>
  Bekijk alvast de oude nieuwsbrieven in het 
  <?=\deceder\view\helpers\Link::Action('archief', 'nieuwsbriefarchief')?>.
</p>
<?php
    break;
  case 2:
?>

<p>
Dag <?=$model->voornaam?> <?=$model->naam?>,
</p>
<p>
We hebben uw e-mailadres (<?=$model->mailadres?>) verwijderd van onze
nieuwsbrief. We vinden het jammer om afscheid van u te nemen; u kunt in
de toekomst onze nieuwsbrieven nog lezen in het
<?=\deceder\view\helpers\Link::Action('archief', 'nieuwsbriefarchief')?>.
</p>

<?php
    break;
  default:
?>

U bent erin geslaagd om een ongeldige inschrijvingsstatus toe te kennnen
aan deze gebruiker. Ik ben wel geïnteresseerd in hoe u dit gedaan hebt.
Laat u het even weten aan helpdesk at johanv.org? Bedankt!

<?php
    break;
}
?>

