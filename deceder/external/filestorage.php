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
 * Singleton for storing and retrieving files.
 *
 * @author johanv
 */
abstract class FileStorage {
  protected static $theInstance;

  /**
   * Store a file.
   * 
   * @param string $name Name to store the file under. If no name is
   *                      given, a random one is generated.
   * @param string $file Path of file to store.
   * @return string The name of the stored file.
   */
  public abstract function store($file, $name = NULL);
  
  /**
   * Retrieve a file
   * 
   * @param string $name Name of file to retrieve.
   * @return string Path of retrieved file.
   */
  public abstract function retrieve($name);
  
  /**
   * Remove a file
   * 
   * @param string $name Name of the file to be removed.
   */
  public abstract function remove($name);
  
  /**
   * Returns the instance of the singleton.
   * 
   * @return \deceder\external\FileStorage
   */
  public static function getInstance() {
    if (self::$theInstance == NULL) {
      self::setInstance(new DefaultFileStorage());
    }
    return self::$theInstance;
  }
  
  /**
   * Replaces the instance.
   * 
   * Normally you don't need this, except for unit testing or something.
   * 
   * @param \deceder\external\FileStorage $instance
   */
  public static function setInstance(FileStorage $instance) {
    self::$theInstance = $instance;
  }
}
