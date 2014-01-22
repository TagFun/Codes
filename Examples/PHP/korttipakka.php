<?php

/* Tarkoituksena on luoda korttipakka, josta randomilla nostetaan joku kortti ja sen jälkeen
poistetaan se pinkasta. Pakkaa pyöritellään läpi niin kauan aikaa, kunnes kaikki kortit on nostettu */


		// Määritellään kaikki pakan kortit tauluun
		$cards = array('spades1', 'spades2', 'spades3', 'spades4', 'spades5', 'spades6', 'spades7', 'spades8', 'spades9', 'spades10', 'spades11', 'spades12', 'spades13', 'club1', 'club2', 'club3', 'club4', 'club5', 'club6', 'club7', 'club8', 'club9', 'club10', 'club11', 'club12', 'club13', 'hearts', 'hearts2', 'hearts3', 'hearts4', 'hearts5', 'hearts6', 'hearts7', 'hearts8', 'hearts9', 'hearts10', 'hearts11', 'hearts12', 'hearts13', 'diamond1', 'diamond2', 'diamond3', 'diamond4', 'diamond5', 'diamond6', 'diamond7', 'diamond8', 'diamond9', 'diamond10', 'diamond11', 'diamond12', 'diamond13');

		do {

			// Suflataan pakka ja randomoidaan kortti
			shuffle($cards);
			$randomCard = ($cards[0]);

			// Poistetaan kortti
			unset($cards[0]);

			// Tulostetaan randomoitu kortti
			echo "Nostettu kortti: " . $randomCard;

			// Tulostetaan kuinka monta korttia on jäljellä
			echo $randomCard . " poisettiin pakasta";
			echo "Kortteja j�ljell�: " . intval(count($cards));

		} while ($cards != NULL)
						
?>
