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

/**
 * Abstract command.
 *
 * @author johanv
 */
abstract class Command
{
    /**
     * Executes the $request, and returns a result.
     *
     * @param Request $request
     * @return mixed
     */
    abstract function execute(Request $request);

    /**
     * Returns an array of required permissions to run the command.
     *
     * @return array of permissions (strings).
     */
    abstract function getRequiredPermissions();
}
