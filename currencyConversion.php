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
			return round($amount*$exchangeRates['quotes']['USDINR'],2);
			break;
			case 'MYR':
			return round($amount*$exchangeRates['quotes']['USDMYR'],2);
			break;
			case 'SGD':
			return round($amount*$exchangeRates['quotes']['USDSGD'],2);
			break;
			case 'CAD':
			return round($amount*$exchangeRates['quotes']['USDCAD'],2);
			break;
			case 'AUD':
			return round($amount*$exchangeRates['quotes']['USDAUD'],2);
			break;
			case 'EUR':
			return round($amount*$exchangeRates['quotes']['USDEUR'],2);
			break;
			
			default:
			return round($amount*$exchangeRates['quotes']['USDUSD'],2);
			break;
		}
		return $exchangeRates['quotes']['USDINR'];
	}
}
//$converted_currency=currencyConverter('USD', 'SGD', 10);
// Print outout
//echo round($converted_currency,2);
?>