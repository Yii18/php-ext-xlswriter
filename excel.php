<?php
$config = ['path' => './tests/'];
$excel = new \Vtiful\Kernel\Excel($config);
$fileFd = $excel->fileName('tutorial01.xlsx');
var_dump($fileFd);
$setHeader = $fileFd->header(['Item', 'Cost']);
var_dump($setHeader);
$setData = $setHeader->data([
        ['Rent', 1000],
        ['Gas',  100],
        ['Food', 300],
        ['Gym',  50],

    ]);
var_dump($setData);
$output = $setData->output();
var_dump($output);



# 出现没有过滤空行代码实例
$config   = ['path' => './tests/'];
$excel    = new \Vtiful\Kernel\Excel($config);
$data = $excel->openFile('1.xlsx')
    ->sheetList();
$result = [];
foreach ($data as $sheetName){
    $rows = $excel->openSheet($sheetName,\Vtiful\Kernel\Excel::SKIP_EMPTY_CELLS | \Vtiful\Kernel\Excel::SKIP_EMPTY_VALUE | \Vtiful\Kernel\Excel::SKIP_EMPTY_ROW);
    while (($row = $rows->nextRow()) !== NULL){
       var_dump($row);
    }
    var_dump($rows->getSheetData());
}

?>

