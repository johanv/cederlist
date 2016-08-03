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

namespace deceder\view\helpers;

/**
 * Klasse die een overzicht van foutmeldingen genereert.
 * 
 * @author johanv
 */
class ErrorSummary {
  /**
   * Rendert een foutoverzicht op basis van $errors.
   * 
   * Dit kan ook nog wel wat beter.
   * 
   * @param array $errors
   * @return string
   */
  static function output(array $errors) {
    $output = "";
    if (count($errors) > 0) {
      $output = "<div class='errors'>\n"
          . "Er liep iets mis:\n"
          . "<ul>\n";
      foreach ($errors as $err) {
        $output .= "<li>$err</li>\n";
      }
      $output .= "</ul>\n";
    }
    return $output;
  }
}
