<?php
require_once __DIR__ . '/../includes/config.php';
$xmlfile = __DIR__.'/students.xml';
if(!file_exists($xmlfile)) { echo 'students.xml not found'; exit; }
$xml = simplexml_load_file($xmlfile);
$insert = $pdo->prepare('INSERT INTO students (name,roll,class) VALUES (?,?,?)');
foreach($xml->student as $s){
  $insert->execute([(string)$s->name, (string)$s->roll, (string)$s->class]);
}
echo 'Imported';
?>