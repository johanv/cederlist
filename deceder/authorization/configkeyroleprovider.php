<?php

namespace deceder\authorization;

/**
 * Kent admin-rol toe op basis van een key in de config file.
 *
 * Als je in je POST-data een key meegeeft die overeenmkomt met de key in
 * de config file, dan krijg je adminrechten.
 * 
 * Dit is tamelijk primitieve autorisatie, maar voorlopig goed genoeg.
 * 
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Authorization
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
