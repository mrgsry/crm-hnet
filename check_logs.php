<?php
$lines = file('storage/logs/laravel.log');
$count = count($lines);
$start = max(0, $count - 200);
for ($i = $start; $i < $count; $i++) {
    if (stripos($lines[$i], 'Berita') !== false || stripos($lines[$i], 'Gagal') !== false || stripos($lines[$i], 'Failed') !== false || stripos($lines[$i], 'attachment') !== false) {
        echo $lines[$i];
    }
}