<?php
require_once "model/Polymorphsm.php";

$company = new Company();
$company->programmer = new Programmer("Agus");
var_dump($company);
echo "<br>";

$company->programmer = new BackendProgrammer("Agus");
var_dump($company);
echo "<br>";

$company->programmer = new FrontendProgrammer("Agus");
var_dump($company);
echo "<br>";



function sayHello(Programmer $programmer)
{
    echo "Hello $programmer->name" . PHP_EOL;
}

echo "<br>";
sayHello(new Programmer("Agus"));
echo "<br>";
sayHello(new BackendProgrammer("Agus"));
echo "<br>";
sayHello(new FrontendProgrammer("Agus"));
echo "<br>";





//instanceof adalah melakukan penecekan apakah termasuk dalam bagian class yang sama atu turunannya

function sayHello2(Programmer $programmer)
{
if ($programmer instanceof BackendProgrammer) {
    echo "Hello Backend Programmer $programmer->name" . PHP_EOL;
} else if ($programmer instanceof FrontendProgrammer) {
    echo "Hello Frontend Programmer $programmer->name" . PHP_EOL;
}else if ($programmer instanceof Programmer) {
    echo "Hello Programmer $programmer->name" . PHP_EOL;
}
}

echo "<br>";
sayHello2(new Programmer("Agus"));
echo "<br>";
sayHello2(new BackendProgrammer("Agus"));
echo "<br>";
sayHello2(new FrontendProgrammer("Agus"));
echo "<br>";