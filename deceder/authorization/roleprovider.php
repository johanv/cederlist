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
 * Een RoleProvider kent rollen toe.
 * 
 * Om een autorisatie-systeem bij te maken, inherit je deze (decorator) klasse.
 * Het decorator pattern laat toe uit meerdere autorisatiesystemen diegene
 * aan te zetten die je nodig hebt, en diegene uit te zetten die je niet nodig
 * hebt. Wat een voordeel is t.o.v. 'gewone' inheritance.
 *
 * @author johanv
 */
abstract class RoleProvider extends Permissions {
  protected $permissions;
  
  function __construct(Permissions $permissions) {
    $this->permissions = $permissions;
  }
}
