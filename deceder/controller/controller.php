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

namespace deceder\controller;

/**
 * De controller handelt de requests af.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Controller
 */
class Controller {
  protected $permissions;
  
  /**
   * Constructor.
   * 
   * @param \deceder\controller\deceder\authorization\Permissions $permissions
   *        klasse die de permissies nakijkt.
   */
  public function __construct(\deceder\authorization\Permissions $permissions) {
    $this->permissions = $permissions;
  }
  
  /**
   * Voert request $r uit.
   * 
   * @param \deceder\controller\Request $r
   * @return int return code.
   */
  public function invoke(Request $r) {
    $commandClass = "\\deceder\\command\\" . ucfirst($r->getAction());
    $command = new $commandClass();
    if (is_a($command, '\deceder\command\Command')) {
      if (!$this->permissions->checkPermissions($r, $command->getRequiredPermissions())) {
        // Dit heeft een geurtje, want eigenlijk mogen we er hier niet vanuit
        // gaan dat een view 'authorization' bestaat.
        $result = new \deceder\controller\ViewResult(NULL, array(), 'authorization');
        $this->display($result, $r->getAction());
        return;
      }
      $result = $command->execute($r);
      
      // Doe iets met het resultaat, alnaargelang het type.
      if (is_a($result, '\deceder\controller\ViewResult')) {
        $this->display($result, $r->getAction());
      }
      if (is_a($result, '\deceder\controller\RedirectResult')) {
        include 'configuration.php';
        header("Location: ". $NIEUWSBRIEF_BASE . "/" . $result->getPath());
        die();
      }
      if (is_a($result, '\deceder\controller\PdfResult')) {
        // Download het PDF-bestand.
        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $result->getFile() . '"');
        readfile(\deceder\external\FileStorage::getInstance()->retrieve($result->getFile()));
        die();
      }
    }
  }
  
  /**
   * Rendert de view.
   * 
   * @param \deceder\controller\ViewResult $viewResult viewResult of a command
   * @param string $action name of the view to use
   * 
   * Als $viewResult->viewOverride is gezet, wordt die gebruikt i.p.v. $action.
   * Die $action parameter is misschien niet juist, misschien moeten we zien
   * dat $viewResult->viewOverride die waarde automatisch bevat. (en dan moet
   * viewOverride wellicht ook een andere naam krijgen.)
   */
  public function display(ViewResult $r, $action) {
    $model = $r->getModel();
    $errors = $r->getErrors();
    
    // Toegegeven: ook dit is gefoefel.
    if (!empty($r->getViewOverride())) {
      $action = $r->getViewOverride();
    }
    $template = "deceder/view/$action.php";
    include 'deceder/view/master.php';
    include $template;
  }
}
