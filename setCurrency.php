<?php
if (isset($_POST['currency'])) {
  # code...
  $currency=$_POST['currency'];
}
else $currency='USD';

switch ($currency) {
  case 'INR':
    $curr_symbol = "&#8377;";
    break;
  case 'USD':
  $curr_symbol="$";
  break;
  case 'AUD':
  $curr_symbol="AU$";
  break;
  case 'MYR':
  $curr_symbol="RM";
  break;
  case 'EUR':
  $curr_symbol="&euro;";
  break;
  case 'CAD':
  $curr_symbol="C$";
  break;
  case 'SGD':
  $curr_symbol="S$";
  break;
  default:
    # code...
    break;
}
?>