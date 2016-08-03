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

namespace deceder\command;

/**
 * Commando voor 'inschrijving aanvragen'.
 *
 * @author johanv
 */
class Inschrijven extends Command {
  public function getRequiredPermissions() {
    // Voor dit commando heb je de permissie 'inschrijving aanvragen' nodig.
    return array('inschrijving aanvragen');
  }
  
  public function execute(\deceder\controller\Request $request) {
    if ($request->isPost()) {
      // haal user-object uit POST-data van het request.
      $user = \deceder\controller\Mapper::mapUser($request);
      $errors = \deceder\validation\UserValidator::validate($user);
      if (count($errors) == 0) {
        // Hmmm. Veel geneste ifs. Het lijkt erop dat dit nog wat
        // verbeterd kan worden.
        $ingeschrevenUser = \deceder\logic\Inschrijving::aanvragen($user);
        return new \deceder\controller\ViewResult($ingeschrevenUser, array(), 'inschrijvingsstatus');
      }
    }
    else {
      $user = new \deceder\model\User();
      $errors = array();
    }
    return new \deceder\controller\ViewResult($user, $errors);
  }
}
