<?php

namespace deceder\authorization;

/**
 * Als je user key gevonden is in de database, dan krijg je de rol 'aangemeld'.
 * 
 * De user key wordt verwacht in de get-parameter 'info' van het request.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Authorization
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
