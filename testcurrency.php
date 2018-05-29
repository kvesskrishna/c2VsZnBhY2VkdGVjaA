<?php
function currencyConverter($from_Currency,$to_Currency,$amount) {

	if($to_Currency=='USD'){
		return $amount;
	}
	else{
		$endpoint = 'live';
		$access_key = '5046ffe6416b3d1a292357e03f646ad4';
// Initialize CURL:
		$ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);
// Decode JSON response:
		$exchangeRates = json_decode($json, true);
// Access the exchange rate values, e.g. GBP:
		switch ($to_Currency) {
			case 'INR':
			return $amount*$exchangeRates['quotes']['USDINR'];
			break;
			case 'MYR':
			return $amount*$exchangeRates['quotes']['USDMYR'];
			break;
			case 'SGD':
			return $amount*$exchangeRates['quotes']['USDSGD'];
			break;
			case 'CAD':
			return $amount*$exchangeRates['quotes']['USDCAD'];
			break;
			case 'AUD':
			return $amount*$exchangeRates['quotes']['USDAUD'];
			break;
			case 'EUR':
			return $amount*$exchangeRates['quotes']['USDEUR'];
			break;
			
			default:
			return $amount*$exchangeRates['quotes']['USDUSD'];
			break;
		}
		return $exchangeRates['quotes']['USDINR'];
	}
}
//$converted_currency=currencyConverter('USD', 'SGD', 10);
// Print outout
//echo round($converted_currency,2);
?>