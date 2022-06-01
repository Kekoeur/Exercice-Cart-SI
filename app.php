<?php
session_start();
require_once __DIR__ .'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Cart\{Book, Music, Bike, Cart, StorageArray, StorageFile, StorageSession, StorageDatabase};

$products = [
    new Book(name : 'Moby Dick', price : 30),
    new Music(name :'AC/DC', price : 17.5),
    new Bike(price: 1430, name :'Brompton'),
];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "Cart";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    echo 'Error: ' . mysql_errno() . ' - ' . mysql_error();
}

$cart = new Cart(storage: new StorageArray(), tva : $_ENV['TVA']);
$cart2 = new Cart(storage: new StorageFile('storage.txt'), tva : $_ENV['TVA']);
$cart3 = new Cart(storage: new StorageSession(), tva : $_ENV['TVA']);
/*StorageDatabase::connection($servername, $username, $password, $dbname);*/
$cart4 = new Cart(storage: new StorageDatabase($conn), tva : $_ENV['TVA']);

echo "Cas du Storage Array\n";
foreach($products as $product)
    $cart->buy($product, 5);

echo  "Total : ". $cart->total()  . "\n";

echo "Cas du Storage File\n";
foreach($products as $product)
    $cart2->buy($product, 5);

echo  "Total : ". $cart2->total()  . "\n";

echo "Cas du Storage Session\n";
foreach($products as $product)
    $cart3->buy($product, 5);

echo  "Total : ". $cart3->total()  . "\n";

echo "Cas du Storage Database\n";
foreach($products as $product)
    $cart4->buy($product, 5);

echo  "Total : ". $cart4->total()  . "\n";

$conn->close();
