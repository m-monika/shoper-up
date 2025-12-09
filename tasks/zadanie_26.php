<?php

$cart = $params[0]; // tej linijki nie ruszamy :)

$totalPriceGr = 0;

$receiptLines = [];

foreach ($cart as $item) {
	$name = $item['name'];
    $priceUnitGr = $item['price']; //w groszach
    $qty = $item['qty'];
	
	$productTotalGr = $priceUnitGr * $qty;
	$totalPriceGr += $productTotalGr; //dalej w groszach
	
	$productTotalZl = $productTotalGr / 100; //w koncu zł
	$formattedPrice = number_format($productTotalZl,  2, ',', '');
	
	$line = sprintf(
        "%dx %s ... ", 
        $qty, 
        $name
    );
    
    $receiptLines[] = $line . $$productTotalZl/$qty . ' PLN';
}

echo "--- TWOJE ZAKUPY ---" . PHP_EOL;

foreach ($receiptLines as $line) {
    echo $line . "\n";
}

echo  "--------------------" . PHP_EOL;

$finalPriceZl = $totalPriceGr / 100;

$formattedFinalPrice = number_format($finalPriceZl, 2, ',', '');

echo "DO ZAPŁATY: " . $formattedFinalPrice . PHP_EOL . "--------------------";