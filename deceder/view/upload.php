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

<h1>Nieuwsbrief uploaden</h1>

<?=\deceder\view\helpers\ErrorSummary::output($errors); ?>
<form enctype="multipart/form-data" method="POST">
    <label for="titel">Titel nieuwsbrief:</label><br />
    <input type="text" name="titel" value="<?=$model->titel?>"><br />
    <label for="begeleidendeTekst">Begeleidende tekst:</label><br />
    <textarea name="begeleidendeTekst" rows="13" cols="80">
<?=$model->begeleidendeTekst ?>
    </textarea><br />
    <label for="uploadedFile">bijlage (pdf):</label><br />
    <input name="uploadedFile" type="file" /><br />    
    <label for="key">Wachtwoord:</label> <br />
    <input type="password" name="key" /> <br/>    
    <input type="hidden" name="isIngevuld" value="1" />
<input type="submit" value="Uploaden en verzenden" />
</form>