<?php
/**
 * Disallow direct access to the file
 */

defined('APPLICATION_LOADED') OR exit('No direct script access allowed');

/**
 * The trip class, Contains the sorting algorithm.
 *
 * @package		propertyfinder devtest
 * @author		Salih Maoui
 *
 * @property-read array $arrivalLocationIndex
 *
 * @property-read array $departureLocationIndex
 *
 * @property-read array $boardingCards
 *
 * @property-read array $sortedCards
 *
 */

class Trip
{
  /**
   * $arrivalLocation Indexes of arrival location
   * @property-read array $arrivalLocationIndex
   */
  private $arrivalLocationIndex =array();

  /**
   * $departureLocation Indexex of departure location
   * @property-read array $departureLocationIndex
   */
  private $departureLocationIndex =array();

  /**
   * $boardingCards array that Contains all Boarding cards in the journey
   * @property-read array $boardingCards
   */
  private $boardingCards= array();

  /**
   * $sortedCards array that Contains the sorted boarding cards
   * @property-read array $sortedCards
   */
  private $sortedCards =array();

  /**
   * Trip Constructor
   * @param array $boardingCards an array of objects each of different type of Boarding passes.
   */
  function __construct($boardingCards)
  {
    $this->boardingCards = $boardingCards;
    $this->setIndex();
  }

  /**
   * addCard Add a new boading card to the journy
   * @param array $boardingCard an array of objects each of different type of Boarding passes.
   */
  public function addCard($boardingCard)
  {
    $this->boardingCards[] = $boardingCard;
    $this->setIndex();
  }


  /**
   * setIndex() Set indexes for departure Location and arrival Location in separate arrays
   */
  protected function setIndex()
  {
    $counter = 0;
    foreach ($this->boardingCards as $value) {
      $this->departureLocationIndex[$counter] = Cards::getDepartureLocation($value);
      $this->arrivalLocationIndex[$counter] = Cards::getArrivalLocation($value);
      $counter++;
    }
  }

  /**
   * getStartingLocation Get the Starting point of the journy.
   * @return int the key of the Starting point in the departureLocation array
   */
  private function getStartingLocation()
  {
    foreach ($this->departureLocationIndex as $key => $value)
      if (!in_array($value, $this->arrivalLocationIndex, true))
          return $key;
    return null;
  }


  /**
   * sortTrip the algorithm for Sort the list
   * @return Return a string of sorted list from departure to arrival
   */
  public function sortTrip()
  {
   $this->sortedCards[] = $this->getStartingLocation();
    for ($i=0; $i < count($this->arrivalLocationIndex) ; $i++) {
      if(isset($this->sortedCards[$i]))
      if (in_array($this->arrivalLocationIndex[$this->sortedCards[$i]], $this->departureLocationIndex, true))
      {
        array_push($this->sortedCards, array_search($this->arrivalLocationIndex[$this->sortedCards[$i]],  $this->departureLocationIndex) );
        array_search($this->arrivalLocationIndex[$this->sortedCards[$i]],  $this->departureLocationIndex);
      }
    }
    return self::toString();
  }


  /**
   * toString() return the sort boarding cards result as a string list .
   */


  protected function toString()
  {
    $str = '<ol>';
    for ($i=0; $i < count($this->sortedCards) ; $i++) {
      $str .= '<li>' . $this->boardingCards[$this->sortedCards[$i]]->toString() . '</li>' . PHP_EOL;
    }
    $str .= '<li>You have arrived at your final destination.</li>' . PHP_EOL;
    $str .= '</ul>';
    return $str;
  }

}


?>
