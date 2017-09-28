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

require __DIR__ . '\vendor\autoload.php';

$request = new \deceder\controller\Request();

// Maak een permissies-object dat kijkt naar de key in de config file,
// en naar de 'code' die users meegeven in hun request.

$permissions = new deceder\authorization\ConfigKeyRoleProvider(
        new deceder\authorization\UserKeyRoleProvider(
            new deceder\authorization\Permissions()));
$controller = new deceder\controller\Controller($permissions);

$controller->invoke($request);