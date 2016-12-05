<?php

namespace deceder\authorization;

/**
 * Klasse die je permissies ophaalt.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Authorization
 */
class Permissions {
  // Primitief permissie- en rollensysteem.

  // Ik definieer de gebruikersrollen in code. Voorlopig is dat
  // goed genoeg.
  // Op termijn kan zoiets uit de database komen.
  
  private $roles = array(
    'anoniem' => array(
      'archief raadplegen' => TRUE,
      'inschrijving aanvragen' => TRUE,
      'uitschrijving aanvragen' => TRUE,
    ),
    'aangemeld' => array(
      'archief raadplegen' => TRUE,
      'inschrijving aanvragen' => TRUE,
      'uitschrijving aanvragen' => TRUE,
      'zichzelf inschrijven' => TRUE,
      'zichzelf uitschrijven' => TRUE,
    ),
    'admin' => array(
      'archief raadplegen' => TRUE,
      'inschrijving aanvragen' => TRUE,
      'uitschrijving aanvragen' => TRUE,
      'zichzelf inschrijven' => TRUE,
      'zichzelf uitschrijven' => TRUE,
      // Ik maak onderscheid tussen uploaden en versturen, zodat we op termijn
      // eventueel kunnen voorzien dat iemand de nieuwsbrief naleest voor hij de
      // deur uit gaat.
      'nieuwsbrief uploaden' => TRUE,
      'nieuwsbrief versturen' => TRUE,
    ),
  );
  
  // Op termijn, als het programma wordt uitgebreid, kunnen er nieuwe
  // permissies bijkomen (bijv. iemand anders inschrijven, iemand anders
  // uitschrijven, nieuwsbrief voorbereiden, nieuwsbrief nalezen).
  // Er kunnen dan ook extra rollen gemaakt worden.
  
  /**
   * Controleert op basis van het request welke gebruikersrol je hebt.
   * 
   * @param \deceder\authorization\deceder\controller\Request $request
   */
  public function getRoles(\deceder\controller\Request $request) {
    // By default heb je de rechten van 'anoniem'.
    return array('anoniem');
  }
  
  /**
   * Levert een array van permissies op.
   * 
   * Het request geven we mee, omdat daar ook de info over de gebruiker in
   * zal zitten. (Misschien dus toch maar gebruiker en request opnemen in
   * grotere klasse, context. Maar dat is voor later.)
   * 
   * @param string $permission - permissie die nagekeken moet worden
   * @param \deceder\controller\Request $request
   * 
   * @return array Array met permissies als key, en TRUE als value voor
   *                toegekende permissies.
   */
  public final function getPermissions(\deceder\controller\Request $request) {
    $result = array();
    foreach ($this->getRoles($request) as $role) {
      if (isset($this->roles[$role])) {
        $result = array_merge($result, $this->roles[$role]);
      }
    }
    return $result;
  }
  
  /**
   * Returns TRUE if the user has all required $permissions.
   * 
   * @param array $permissions permissions to check for.
   * @return bool TRUE if the user has all required $permissions.
   */
  public final function checkPermissions(\deceder\controller\Request $request, array $permissions) {
    $result = TRUE;
    $actualPermissions = $this->getPermissions($request);
    foreach ($permissions AS $perm) {
      if (isset($actualPermissions[$perm])) {
        $result &= $actualPermissions[$perm];
      }
      else {
        return FALSE;
      }
    }
    return $result;
  }
}
