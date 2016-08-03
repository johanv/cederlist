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

<h1>Uitschrijven voor de nieuwsbrief</h1>

<form method="post">
      Als u <?=$model->voornaam?> <?=$model->naam?> (<?=$model->mailadres?>)
      wilt uitschrijven voor de nieuwsbrief, klik dan op de knop:  <br />
      <input type="submit" name="uitschrijven" value="uitschrijven"> <br />
      <br />
      <?=\deceder\view\helpers\Link::Action('archief', 'Klik hier')?> als u
      niemand wilt uitschrijven.
</form>