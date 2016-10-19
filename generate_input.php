<?php

const INPUT_SIZE = 100000;

header('Content-Type: text/plain');

set_time_limit(0);
ini_set('memory_limit', '-1');

$ids  = [];
$data = [];

$destination = md5(uniqid());
$ids[]       = $destination;

for ($i = 0; $i < INPUT_SIZE; $i++) {

    $source = $destination;

    $destination = md5(uniqid());
    while (in_array($destination, $ids, true)) {
        $destination = md5(uniqid());
    }
    $ids[] = $destination;

    $type = rand(0, 2);

    switch ($type) {
        case 0:
            $data[] = ['airport_bus', $source, $destination, md5(uniqid())];
            break;

        case 1:
            $data[] = ['train', $source, $destination, md5(uniqid()), md5(uniqid())];
            break;

        case 2:
            $data[] = ['flight', $source, $destination, md5(uniqid()), md5(uniqid()), md5(uniqid()), md5(uniqid())];
            break;
    }
}

shuffle($data);

if (($handle = fopen('large.csv', "w")) !== false) {
    foreach ($data as $item) {
        fputcsv($handle, $item);
    }
    fclose($handle);
} else {
    throw new InvalidArgumentException('Failed to open CSV input file.');
}

echo 'Data written to large.csv file';
