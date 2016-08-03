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

namespace deceder\authorization;

/**
 * Als je user key gevonden is in de database, dan krijg je de rol 'aangemeld'.
 * 
 * De user key wordt verwacht in de get-parameter 'info' van het request.
 *
 * @author johanv
 */
class UserKeyRoleProvider extends RoleProvider {
  public function getRoles(\deceder\controller\Request $request) {
    // Welke rollen had ik al?
    $result = $this->permissions->getRoles($request);
    
    $user = \deceder\data\Data::getInstance()->getUserFromKey($request->getGet('info'));
    if ($user != NULL) {
      // Iemand gaf een geldige user key mee. Hij krijgt de rol 'aangemeld'.
      $result[] = 'aangemeld';
    }
    return $result;
  }
}
