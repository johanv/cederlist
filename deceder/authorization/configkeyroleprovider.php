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
 * Kent admin-rol toe op basis van een key in de config file.
 *
 * Als je in je POST-data een key meegeeft die overeenmkomt met de key in
 * de config file, dan krijg je adminrechten.
 * 
 * Dit is tamelijk primitieve autorisatie, maar voorlopig goed genoeg.
 * 
 * @author johanv
 */
class ConfigKeyRoleProvider extends RoleProvider {
  public function getRoles(\deceder\controller\Request $request) {
    // Welke rollen had ik sowieso al?
    $result = $this->permissions->getRoles($request);
    
    include 'configuration.php';
    
    if (isset($AUTHORIZATION_KEY) && $request->getPost('key') == $AUTHORIZATION_KEY) {
      // Als je de key uit de config file mee kunt posten, dan krijg je
      // adminrechten.
      $result[] = 'admin';
    }
    return $result;
  }
}
