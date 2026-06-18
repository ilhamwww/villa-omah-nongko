<?php

$replacements = [
    'admin@umahdaun.com' => 'admin@omahnongko.com',
    'info@umahdaun.com' => 'info@omahnongko.com',
    'instagram.com/umahdaun' => 'instagram.com/omahnongko',
    'facebook.com/umahdaun' => 'facebook.com/omahnongko',
    'tiktok.com/@umahdaun' => 'tiktok.com/@omahnongko',
    'youtube.com/@umahdaun' => 'youtube.com/@omahnongko',
    '@umahdaun' => '@omahnongko',
    'Villa Umah Daun' => 'Villa Omah Nongko',
    'Umah Daun' => 'Omah Nongko',
    'umah daun' => 'Omah Nongko',
    'umahdaun' => 'omahnongko',
    'UmahDaun' => 'OmahNongko',
];

$dirs = [
    'config',
    'database',
    'resources/views',
];

$files = [
    'PRD.md',
    'DESIGN.md',
];

// Helper function to scan recursively
function getFiles($dir) {
    $results = [];
    if (!is_dir($dir)) return [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            $results = array_merge($results, getFiles($path));
        } else {
            $results[] = $path;
        }
    }
    return $results;
}

foreach ($dirs as $d) {
    $files = array_merge($files, getFiles($d));
}

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    $original = $content;
    
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    if ($content !== $original) {
        file_put_contents($file, $content);
        echo "Updated: $file\n";
    }
}

echo "Replacements complete!\n";