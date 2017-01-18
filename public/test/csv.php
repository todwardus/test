<?php

$csv = array_map('str_getcsv', file('csv.csv'));

print_r($csv);
?>