<?php

namespace deceder\authorization;

/**
 * Een RoleProvider kent rollen toe.
 * 
 * Om een autorisatie-systeem bij te maken, inherit je deze (decorator) klasse.
 * Het decorator pattern laat toe uit meerdere autorisatiesystemen diegene
 * aan te zetten die je nodig hebt, en diegene uit te zetten die je niet nodig
 * hebt. Wat een voordeel is t.o.v. 'gewone' inheritance.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Authorization
 */
abstract class RoleProvider extends Permissions {
  protected $permissions;
  
  function __construct(Permissions $permissions) {
    $this->permissions = $permissions;
  }
}
