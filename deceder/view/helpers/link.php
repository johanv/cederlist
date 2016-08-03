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

namespace deceder\view\helpers;

/**
 * Helper om url's te genereren in views.
 *
 * @author johanv
 */
class Link {
  /**
   * Levert een link op naar de gegeven actie.
   * 
   * @param string $action actie waarnaar te linken.
   * @param string $linktekst tekst voor de link.
   * @return link naar de gegeven actie.
   */
  public static function Action($action, $linktekst) {
    if (!preg_match('@^([a-zA-Z0-9_/-]*)$@', $action)) {
      throw new \Exception("Deze actie is te louche.");
    }
    include 'configuration.php';
    return "<a href='$NIEUWSBRIEF_BASE/$action'>" . strip_tags($linktekst) . "</a>";    
  }
}
