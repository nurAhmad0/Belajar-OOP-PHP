<?php
require "model/orang.php";

$orang1 = new Orang();
// $orang1->nama = 'agus'; //jadi di masukkan kedalam construktor name di clas orang
// $orang1->saldo = '500'; //jadi di masukkan kedalam construktor name di clas orang
// $orang1->umur = '19'; //jadi di masukkan kedalam construktor name di clas orang
$orang1->set_nama("agus");
$orang1->tampilkanNama();
echo"<br>";


var_dump($orang1);
echo"<br>";









require "model/cont&deconst.php";
$hewan1 = new Hewan("siti", 5, "rumput");
var_dump($hewan1);
echo"<br>";
echo"skript selesai";
echo"<br>";








require "model/mobil.php";
$mobil1 = new Mobil("honda", 35);
var_dump($mobil1);
$mobil1->sayJenis();
$mobil1->khususMobil();
echo"<br>";
echo"<br>";


require "model/motor.php";
$motor1 = new Motor("yamaha", 50);
var_dump($motor1);
$motor1->sayJenis();
$motor1->khususMotor();
echo"<br>";
echo"<br>";