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
 * Klasse die het URL-request voorstelt.
 *
 * Misschien moet het request deel uitmaken van een (ruimere) context, daar
 * ben ik nog niet uit.
 *
 * @author johanv
 */
class Request {
  protected $action = null;
  protected $urlExtra = array();
  protected $get = array();
  protected $post = array();
  protected $files = array();
  protected $defaultAction = 'archief';
  
  /**
   * Verzamelt wat informatie over het PHP-request.
   * 
   * Bijvoorbeeld: als de url /nieuwsbrief/uitschrijven/12345 is, dan
   * wordt $action 'uitschrijven' en $urlExtra[0] 12345. $get bevat de url-
   * variabelen met uitzondering van 'q', en $post de post-dingen.
   */
  public function __construct() {
    $this->urlExtra = explode('/', filter_input(INPUT_GET, 'q'));
    $this->action = array_shift($this->urlExtra);
    // Van onderstaande ben ik niet zo zeker.
    $this->get = $_GET;
    unset($this->get['q']);
    $this->post = $_POST;
    $this->files = $_FILES;
  }
  
  public function getAction() {
    if (empty($this->action)) {
      return $this->defaultAction;
    }
    return $this->action;
  }
  
  /**
   * Haalt extra 'stukken' op uit de url, na de actie.
   * 
   * @param integer $i
   * @return string
   */
  public function getUrlExtra($i) {
    return $this->urlExtra[$i];
  }
    
  public function getGet($key) {
    if (isset($this->get) && isset($this->get[$key])) {
      return $this->get[$key];
    }
    return NULL;
  }
  
  public function getPost($key) {
    if (isset($this->post) && isset($this->post[$key])) {
      return $this->post[$key];
    }
    return NULL;
  }
  
  public function getFile($key) {
    if (isset($this->files) && isset($this->files[$key])) {
      return $this->files[$key];
    }
    return NULL;
  }
  
  public function isPost() {
    return isset($this->post) && count($this->post) > 0;
  }
  
  public function hasFiles() {
    return isset($this->files) && count($this->files) > 0;
  }
}
