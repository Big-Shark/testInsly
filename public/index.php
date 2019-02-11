<?php

require_once __DIR__.'/../autoload.php';

if (!array_key_exists('value', $_POST) || (int)$_POST['value'] < 100 || (int)$_POST['value'] > 100000) {
    throw new Exception('Value is not correct');
}

if (!array_key_exists('tax', $_POST) || (int)$_POST['tax'] < 0 || (int)$_POST['tax'] > 100) {
    throw new Exception('Tax is not correct');
}

if (!array_key_exists('instalments', $_POST) || (int)$_POST['instalments'] < 0 || (int)$_POST['instalments'] > 12) {
    throw new Exception('Instalments is not correct');
}

if (!array_key_exists('user_time', $_POST) || count((new DateTimeImmutable($_POST['user_time']))->getLastErrors()) === 0) {
    throw new Exception('Instalments is not correct');
}

$value = (int) $_POST['value'];
$tax = (int) $_POST['tax'];
$instalments = (int) $_POST['instalments'];
$userTime = new DateTimeImmutable($_POST['user_time']);

$calculator = new \InsuranceCalculator\Calculator(
    (new \InsuranceCalculator\BasePriceCalculator($userTime)),
    (new \InsuranceCalculator\CommissionCalculator()),
    (new \InsuranceCalculator\TaxCalculator())
);
$result = $calculator($value*100, $tax, $instalments);

header('Access-Control-Allow-Origin: *');
header('Content-Type: : application/json');
echo json_encode($result);
