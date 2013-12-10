<?php
// get options
$options = getopt("f:n:d:");

// validate
if (!isset($options['f']) || !isset($options['n'])) {
    echo "Some Paramerters Missing";
    echo "Usage: -d <delimiter> -f <file path> -n <date column number (separated at , )>";
}

// set options
$numbers = split(",", trim($options['n']));
$delimiter = (isset($options['d'])) ? $options['d'] : "";

// file open
$file = file($options['f']);

foreach ($file as $line) {
    $line = trim($line);
    if (!empty($delimiter)) {
        $columns = split($delimiter, $line);
    } else {
        $columns = array($line);
    }

    $new_line = "";
    $col_cnt = count($columns);
    foreach ($columns as $k => $column) {
        if (in_array($k, $numbers)) {
            $new_line .= date('D M d H:i:s T Y', strtotime($column." + 9 hours"));
        } else {
            $new_line .= $column;
        }
        if ($k+1 != $col_cnt) {
            $new_line .= $delimiter;
        }
    }
    echo $new_line . "\n";
}


