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

// Dit is erg minimaal. Je past dit beter aan :-)

include 'configuration.php';
?>

<html>
    <head>
        <title>Cederlist</title>
    </head>
    <body>
        <header>
            <?=\deceder\view\helpers\Link::Action('archief', 'archief')?>
            <?=\deceder\view\helpers\Link::Action('inschrijven', 'inschrijven')?>
            <?=\deceder\view\helpers\Link::Action('upload', 'uploaden en verzenden')?>
        </header>
        <main>
	
