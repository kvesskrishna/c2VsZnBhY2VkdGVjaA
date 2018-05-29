<?php

include_once('currencyConversion.php');

require_once('setCurrency.php');

$converted_actualprice=$curr_symbol." ".currencyConverter('USD',$currency,$_POST['actualprice']);
$converted_offerprice=$curr_symbol." ".currencyConverter('USD',$currency,$_POST['offerprice']);
echo "Course Price: <small style='text-decoration:line-through'>".$converted_actualprice."</small> ".$converted_offerprice;
?>