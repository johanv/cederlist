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

include 'configuration.php';
// Lelijke lay-out, maar dat was zo al :-)

?>

<h1>Nieuwsbriefarchief</h1>

<?php

foreach ($model as $nieuwsbrief) {
?>
<p align="left" class="style1">
    <!-- TODO: die URL moet hier niet in de view zitten: -->
    <?=\deceder\view\helpers\Link::Action('download/' . $nieuwsbrief->id, $nieuwsbrief->titel)?>
    (<?=date("d M Y",strtotime($nieuwsbrief->verzendingsdatum))?>) 
</p>
<?php
}
?>
