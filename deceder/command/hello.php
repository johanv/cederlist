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

/**
 * Description of hello
 *
 * @author johanv
 */
class Hello extends Command
{
    /**
     * Om dit commando uit te voeren, heb je 'archief raadplegen'-permissie nodig.
     *
     * @return array of permissions.
     */
    public final function getRequiredPermissions()
    {
        return ['archief raadplegen'];
    }

    /**
     * The Hello command.
     *
     * @param  Request $request
     * @return \deceder\controller\Result.
     */
    public function execute(Request $request)
    {
        $result = new ViewResult($request->getUrlExtra(0));
        return $result;
    }
}
