--TEST--
Check for vtiful presence
--SKIPIF--
<?php if (!extension_loaded("xlswriter")) print "skip"; ?>
--FILE--
<?php
$config   = ['path' => './tests'];
$excel    = new \Vtiful\Kernel\Excel($config);
$filePath = $excel->fileName('tutorial.xlsx')
    ->header(['Item', 'Cost'])
    ->output();

$data = $excel->openFile('tutorial.xlsx')->openSheet()->getSheetData();

var_dump($data);
?>
--CLEAN--
<?php
@unlink(__DIR__ . '/tutorial.xlsx');
?>
--EXPECT--
array(1) {
  [0]=>
  array(2) {
    [0]=>
    string(4) "Item"
    [1]=>
    string(4) "Cost"
  }
}