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
 * Toont het overzicht van oude nieuwsbrieven.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Command
 */
class Archief extends Command {
  public function getRequiredPermissions() {
    return array('archief raadplegen');
  }
  
  public function execute(\deceder\controller\Request $request) {
    $edities = \deceder\data\Data::getInstance()->getAllVerzondenNieuwsbrieven();
    return new \deceder\controller\ViewResult($edities);
  }
}
