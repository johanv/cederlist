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

namespace deceder\controller;

/**
 * Mapping van POST-data naar het model.
 * 
 * Dit zit mogelijk niet helemaal op de juiste plaats.
 *
 * @author johanv
 */
class Mapper {
  public static function mapUser(Request $request) {
    if (!$request->isPost()) {
      return NULL;
    }
    // Vermoedelijk kan onderstaande wat generieker.
    // FIXME: wat error handling zou geen kwaad kunnen.
    $result = new \deceder\model\User();
    $result->voornaam = $request->getPost('voornaam');
    $result->naam = $request->getPost('naam');
    $result->relatie = $request->getPost('relatie');
    $result->ouderVan = $request->getPost('oudervan');
    $result->mailadres = $request->getPost('mail');

    return $result;
  }
  
  public static function MapNieuwsbrief(Request $request) {
    $result = new \deceder\model\Nieuwsbrief();
    $result->titel = $request->getPost('titel');
    $result->uploadedFile = $request->getFile('uploadedFile');
    $result->begeleidendeTekst = $request->getPost('begeleidendeTekst');

    return $result;
  }
}
