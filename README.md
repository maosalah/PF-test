## Test Usage
 There is test code in test/index.php which tests it with different order.
 or by commande line
	$ php test/index.php

## Example Usage

As in index.php file:

	<?php
	include_once("api/initialize.php");

	$trip = new Trip([
	    new Cards("bus",'Barcelona', 'Gerona Airport'),
	    new Cards("train",'Madrid', 'Barcelona', '45B', '78A'),
	    new Cards("flight", 'Stockholm', 'New York JFK', '7B', 'SK22', '22'),
			new Cards("flight", 'Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344')
	  ]);


	echo $trip->sortTrip();

	?>

OR by using addCard Function

<?php

	include_once("api/initialize.php");

	$trip = new Trip();
	$trip->addCard(new Cards("bus",'Barcelona', 'Gerona Airport'));
	$trip->addCard(new Cards("train",'Madrid', 'Barcelona', '45B', '78A'));
	$trip->addCard(new Cards("flight", 'Stockholm', 'New York JFK', '7B', 'SK22', '22'));
	$trip->addCard(new Cards("flight", 'Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344'));

	echo $trip->sortTrip();

?>


It should output sorted list.
