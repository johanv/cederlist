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

<h1>Inschrijving bevestigd</h1>

Bedankt <?=$model->voornaam?> <?=$model->naam?>, om in te schrijven voor
onze nieuwsbrief. U ontvangt hem vanaf nu op <?=$model->mailadres?>.


<p>
    Bekijk alvast het 
    <?=\deceder\view\helpers\Link::Action('archief', 'nieuwsbriefarchief')?>.
</p>