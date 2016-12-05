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

namespace deceder\external;

/**
 * Singleton for sending e-mails.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category External
 */
abstract class Mailer {
  protected static $theInstance;
  
  /**
   * Send out an e-mail.
   * 
   * @param \deceder\model\Email $email email to send
   */
  public abstract function send(\deceder\model\Email $email);

  /**
   * Levert instantie voor data access op.
   * 
   * @return Mailer
   */
  public static function getInstance() {
    if (self::$theInstance == NULL) {
      // Standaard worden mails verstuurd door de php-functie 'mail' 
      // aan te roepen. Maar als je wilt, kun je dat overriden, bijvoorbeeld
      // om te testen
      self::setInstance(new DefaultMailer());
    }
    return self::$theInstance;
  }
  
  /**
   * Verander de instantie voor data acces.
   * 
   * Dit is normaal enkel nodig als je unit tests of zo gaat doen.
   * 
   * @param \deceder\data\Data $instance nieuwe instantie.
   */
  public static function setInstance(Mailer $instance) {
    self::$theInstance = $instance;
  }
}