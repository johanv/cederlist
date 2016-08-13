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
 * Description of defaultfilestorage
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category External
 */
class DefaultFileStorage extends FileStorage {
  protected $storagePath;
  
  public function __construct() {
    include 'configuration.php';
    $this->storagePath = $FILE_ARCHIVE;
  }
  
  /**
   * Remove a file
   * 
   * @param string $name Name of the file to be removed.
   */  
  public function remove($name) {
    unlink($this->retrieve($name));
  }

  /**
   * Retrieve a file
   * 
   * @param string $name Name of file to retrieve.
   * @return string Path of retrieved file, or NULL if not found.
   */  
  public function retrieve($name) {
    $filename = $this->storagePath . DIRECTORY_SEPARATOR . basename($name);
    return file_exists($filename) ? $filename : NULL;
  }

  /**
   * Store a file.
   * 
   * @param string $name Name to store the file under. If no name is
   *                      given, a random one is generated.
   * @param string $file Path of file to store.
   * @return string The name of the stored file.
   */
  public function store($file, $name = NULL) {
    if (empty($name)) {
      while (TRUE) {
        $name = uniqid('deceder', true) . '.pdf';
          if (!$this->retrieve($name)) {
          // Als het bestand nog niet bestaat, is het goed.
          break;
        }
      }
    }
    $dest = $this->storagePath . DIRECTORY_SEPARATOR . basename($name);
    copy($file, $dest);
    return $name;
  }

//put your code here
}
