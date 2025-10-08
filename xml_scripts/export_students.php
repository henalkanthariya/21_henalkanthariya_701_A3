<?php
require_once __DIR__ . '/../includes/config.php';
$rows = $pdo->query('SELECT * FROM students')->fetchAll(PDO::FETCH_ASSOC);
$dom = new DOMDocument('1.0','utf-8');
$root = $dom->createElement('students');
foreach($rows as $r){
  $st = $dom->createElement('student');
  $st->appendChild($dom->createElement('name', $r['name']));
  $st->appendChild($dom->createElement('roll', $r['roll']));
  $st->appendChild($dom->createElement('class', $r['class']));
  $root->appendChild($st);
}
$dom->appendChild($root);
$dom->save(__DIR__.'/students_exported.xml');
echo 'Exported to students_exported.xml';
?>