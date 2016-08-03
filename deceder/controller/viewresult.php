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
 * Description of view
 *
 * @author johanv
 */
class ViewResult extends Result {
  protected $model;
  protected $errors;
  protected $viewOverride;
  
  /**
   * Constueert een resultaat dat naar een view kan.
   * 
   * @param type $model Te tonen model.
   * @param array $errors Validatie-errors als key-value array. De key
   *                      kan verwijzen naar een component (maar dat moet ik
   *                      nog wat beter uitwerken.)
   * @param string $viewOverride Als niet NULL, dan is het de bedoeling dat
   *                              de view met deze naam getoond wordt, in
   *                              plaats van de standaardview.
   */
  public function __construct($model, array $errors = array(), $viewOverride = NULL) {
    if ($errors === NULL) {
      $errors = array();
    }
    $this->model = $model;
    $this->errors = $errors;
    $this->viewOverride = $viewOverride;
  }
 
  /**
   * Levert het model op.
   * 
   * @return type Het model.
   */
  public function getModel() {
    return $this->model;
  }
  
  /**
   * Levert de validatie-errors op.
   * 
   * @return array
   */
  public function getErrors() {
    return $this->errors;
  }
  
  /**
   * Bevat naam van de te tonen view (optioneel).
   * 
   * Als deze NULL blijft, dan zal gewoon de standaardview getoond worden.
   * 
   * @return string
   */
  public function getViewOverride() {
    return $this->viewOverride;
  }
}
