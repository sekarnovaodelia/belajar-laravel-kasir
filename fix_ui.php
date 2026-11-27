<?php

$files = [
    'resources/views/barang/create.blade.php',
    'resources/views/barang/edit.blade.php',
    'resources/views/jenis/create.blade.php',
    'resources/views/jenis/edit.blade.php',
    'resources/views/pelanggan/create.blade.php',
    'resources/views/pelanggan/edit.blade.php',
    'resources/views/supplier/create.blade.php',
    'resources/views/supplier/edit.blade.php',
    'resources/views/stok_masuk/create.blade.php',
];

$targets = [
    'card pos-card col-12 col-md-8 col-lg-6 mx-auto',
    'card pos-card col-12 col-md-6 mx-auto',
    'card pos-card col-lg-8 mx-auto',
    'card pos-card col-lg-6 mx-auto',
    'card pos-card col-lg-8',
    'card pos-card col-lg-6',
];

foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (!file_exists($path)) continue;

    $content = file_get_contents($path);
    $updated = str_replace($targets, 'card pos-card col-12', $content);

    if ($content !== $updated) {
        file_put_contents($path, $updated);
        echo "[OK] $file diperbaiki (rata kiri / full width).\n";
    }
}