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
use deceder\controller\Mapper;
use deceder\controller\ViewResult;
use deceder\logic\Inschrijving;
use deceder\model\User;
use deceder\validation\UserValidator;

/**
 * Commando voor 'inschrijving aanvragen'.
 *
 * @author johanv
 */
class Inschrijven extends Command
{

    /**
     * @return array
     */
    public function getRequiredPermissions()
    {
        // Voor dit commando heb je de permissie 'inschrijving aanvragen' nodig.
        return ['inschrijving aanvragen'];
    }

    /**
     * @param \deceder\controller\Request $request
     * @return ViewResult
     */
    public function execute(\deceder\controller\Request $request)
    {
        if ($request->isPost()) {
            // haal user-object uit POST-data van het request.
            $user = Mapper::mapUser($request);
            $errors = UserValidator::validate($user);

            if (count($errors) == 0) {
                // Hmmm. Veel geneste ifs. Het lijkt erop dat dit nog wat
                // verbeterd kan worden.
                $ingeschrevenUser = Inschrijving::aanvragen($user);
                return new ViewResult($ingeschrevenUser, [], 'inschrijvingsstatus');
            }
        } else {
            $user = new User();
            $errors = [];
        }

        return new ViewResult($user, $errors);
    }
}
