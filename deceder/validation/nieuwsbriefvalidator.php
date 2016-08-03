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

namespace deceder\validation;

/**
 * Validatie van een nieuwsbrief (een nummer eigenlijk).
 *
 * @author johanv
 */
class NieuwsbriefValidator {
  /**
   * Valideert een nieuwsbrief.
   * 
   * @param \deceder\model\Nieuwsbrief $nieuwsbrief
   */
  public static function Validate(\deceder\model\Nieuwsbrief $nieuwsbrief) {
    include 'configuration.php';
    $errors = array();
    if (!empty($nieuwsbrief->uploadedFile)) {
      if (!empty($nieuwsbrief->uploadedFile['type']) && 
          $nieuwsbrief->uploadedFile['type'] != 'application/pdf') {
        // Voorlopig accepteren we alleen PDF-bijlagen (zodat ze zeker geen
        // docx-bestanden zouden versturen ;))
        $errors['uploadedFile'] = 'Bijlage moet PDF zijn.';
      }
      if ($nieuwsbrief->uploadedFile['size'] > $MAX_FILE_SIZE) {
        // Voorlopig accepteren we alleen PDF-bijlagen (zodat ze zeker geen
        // docx-bestanden zouden versturen ;))
        $errors['uploadedFile'] = 'Bijlage mag niet groter zijn dan '
            . $MAX_FILE_SIZE . ' bytes (' . $MAX_FILE_SIZE/1024 . ' KB).';
      }
    }
    if (empty($nieuwsbrief->titel)) {
      $errors['titel'] = 'Een nieuwsbrief moet een titel hebben.';
    } 
    return $errors;
  }
}
