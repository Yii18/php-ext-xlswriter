<?php
# 出现没有过滤空行代码实例
# excel地址、请务必使用此excel才能复现 https://github.com/viest/php-ext-xlswriter/files/5713368/1.xlsx
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
