<?php

namespace deceder\model;

/**
 * Class representing an e-mail.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Model
 */
class Email {
  public $from;
  public $to;
  public $bcc;
  public $subject;
  public $body;
  public $attachments;
  
  public function __construct() {
    $this->attachments = array();
  }
}
