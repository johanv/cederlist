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

<script language="JavaScript">
  // Dat ziet me er hier een louche scriptje uit. Ik bleef er alvast af :-)

function OnChange() { 
	
	var sel = document.inschrijven.relatie.value;
	if (sel == 1)
	{
		document.all["oudervan"].style.visibility = 'visible'; 
		ouder.style.display = 'block';
	}
	else
	{
		document.all["oudervan"].style.visibility = 'hidden'; 
		ouder.style.display = 'none';
	}
		
}
</script>
<h1>Inschrijven voor de nieuwsbrief</h1>

<?=\deceder\view\helpers\ErrorSummary::output($errors); ?>
<form method="post" name="inschrijven">
    <label for="voornaam">Voornaam:</label> <br />
    <input type="text" name="voornaam" value="<?=$model->voornaam?>"> <br />
    <label for="naam">Naam:</label> <br />
    <input type="text" name="naam" value="<?=$model->naam?>"> <br />
    <label for="relatie">Mijn relatie met de school:</label> <br />
    <select name="relatie" onchange="OnChange();" value="<?=$model->relatie?>">
        <option value="1">ouder van kind</option>
        <option value="2">familie van leerling</option>
        <option value="3">sympathisant</option>
    </select> <br />
    <div id="ouder">
        <label for="oudervan">Naam kind(eren):</label> <br />
        <input type="text" name="oudervan" value="<?=$model->ouderVan?>">
    </div>
    <label for="mail">e-mailadres:</label> <br />
    <input type="email" name="mail" value="<?=$model->mailadres?>"> <br />
    <input type="submit" name="verzenden" value="verzenden">
</form>
<span class="style1">Uw gegevens zijn veilig bij <?=$ORGANIZATION_NAME?>; wij verbinden ons ertoe nooit e-mailadressen door te geven aan derden zonder uw toestemming.</span>