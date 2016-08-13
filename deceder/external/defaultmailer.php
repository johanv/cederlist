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
 * This mailer just sends out e-mail. :-)
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category External
 */
class DefaultMailer extends Mailer {
  /**
   * Send out an e-mail.
   * 
   * @param \deceder\model\Email $email email to send
   */
  public function send(\deceder\model\Email $email) {
    // In de originele toepassing stond er hocus-pocus  die
    // erg leek op http://stackoverflow.com/a/31428803/1417449
    // Ik heb dan maar die manier van werken overgenomen.
    // 
    // Maar op termijn gebruiken we beter PHPmailer.
    
    $headers = "From: {$email->from}\n";
    
    if (!empty($email->bcc)) {
      $headers .= "Bcc: {$email->bcc}";
    }
    
    if (count($email->attachments) > 0) {
      // a random hash will be necessary to send mixed content
      $separator = md5(time());

      // carriage return type (we use a PHP end of line constant)
      $eol = PHP_EOL;
      $headers .= "MIME-Version: 1.0" . $eol;
      $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
      $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
      $body = "This is a MIME encoded message." . $eol;
      
      // message
      $body = "--" . $separator . $eol;
      $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
      $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
      $body .= $email->body . $eol . $eol;
      
      foreach ($email->attachments as $file) {
        $handle = fopen($file, "r");
        $content = file_get_contents($file);
        fclose($handle);
        $content = chunk_split(base64_encode($content));
        
        $body .= "--" . $separator . $eol;
        // Ook hier zit hardgecodeerd dat de bijlage een PDF is.
        $body .= "Content-Type: application/pdf; name=\"" . basename($file) . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment; filename=\"" . basename($file) . "\"" . $eol . $eol;
        $body .= $content . $eol . $eol;
      }
      $body .= "--" . $separator . "--";
    }
    else {
      $body = $email->body;
    }
    
    mail($email->to, $email->subject, $body, $headers);
  }
}
