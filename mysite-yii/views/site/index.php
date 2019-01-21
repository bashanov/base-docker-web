<?php

use app\models\BaseTable;

$baseTable = BaseTable::findOne(1);
echo sprintf("%s [Installed %s]", $baseTable->info, $baseTable->created_at);
