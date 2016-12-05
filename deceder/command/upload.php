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
use deceder\controller\RedirectResult;
use deceder\controller\ViewResult;
use deceder\logic\Nieuwsbrief;
use deceder\validation\NieuwsbriefValidator;

/**
 * Commando voor nieuwsbrief uploaden.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Command
 */
class Upload extends Command
{
    /**
     * @return array
     */
    public function getRequiredPermissions()
    {
        return ['nieuwsbrief uploaden'];
    }

    public function execute(\deceder\controller\Request $request)
    {
        if ($request->getPost('isIngevuld')) {
            $nieuwsbrief = Mapper::mapNieuwsbrief($request);

            // Valideren: als er bijlage is, moet ze pdf zijn, en mag ze niet te
            // groot zijn.
            // Op termijn misschien ook of begeleidende tekst wel degelijk plain
            // text is, en of tokens wel kloppen.
            $errors = NieuwsbriefValidator::validate($nieuwsbrief);

            if (count($errors) == 0) {
                // We doen voorlopig zowel registreren als verzenden.
                Nieuwsbrief::registreren($nieuwsbrief);
                Nieuwsbrief::verzenden($nieuwsbrief);

                return new RedirectResult('archief');
            }

            $model = $nieuwsbrief;
        } else {
            $model = new \deceder\model\Nieuwsbrief();
            $errors = [];
        }

        return new ViewResult($model, $errors);
    }
}
