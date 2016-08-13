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

use deceder\controller\Request;
use deceder\controller\ViewResult;
use deceder\data\Data;
use deceder\logic\Inschrijving;

/**
 * Description of uitschrijven
 *
 * @author johanv
 */
class Uitschrijven extends command
{
    /**
     * @return array
     */
    public function getRequiredPermissions()
    {
        return ['zichzelf uitschrijven'];
    }

    public function execute(Request $request)
    {
        // Toegegeven. De user ophalen is omslachtig.
        $user = Data::getInstance()->getUserFromKey($request->getGet('info'));

        if ($request->isPost()) {
            Inschrijving::uitschrijven($user);
            return new ViewResult($user, [], 'inschrijvingsstatus');
        }
        return new ViewResult($user);
    }
}
