<?php
include 'connection.php';

function getQuartile($data, $percentile) {
    // sort($data);
    $pos = $percentile * (count($data) - 1);
    $low = floor($pos);
    $high = ceil($pos);
    $fraction = $pos - $low;

    if($low == $high) {
        return $data[$low];
    }
    return $data[$low] + $fraction * ($data[$high] - $data[$low]);
}

function standarDeviasiPopulasi($data) {
    $n = count($data);
    $mean = array_sum($data) / $n;
    $sum = 0;
    
    foreach ($data as $value) {
        $sum += pow($value - $mean, 2);
    }
    
    return sqrt($sum / $n);
}

function standarDeviasiSampel($data) {
    $n = count($data);
    if ($n <= 1) return 0;
    $mean = array_sum($data) / $n;
    $sum = 0;
    
    foreach ($data as $value) {
        $sum += pow($value - $mean, 2);
    }
    
    return sqrt($sum / ($n - 1));
}

function getMean($data) {
    return array_sum($data) / count($data);
}

?>