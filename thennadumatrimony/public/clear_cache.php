<?php
// Script to clear Laravel cache manually
$paths = [
    __DIR__ . '/../storage/framework/cache',
    __DIR__ . '/../storage/framework/sessions',
    __DIR__ . '/../storage/framework/views',
    __DIR__ . '/../bootstrap/cache/config.php'
];

foreach ($paths as $path) {
    if (file_exists($path)) {
        if (is_dir($path)) {
            $files = glob($path . '/*');
            foreach ($files as $file) {
                if (is_file($file)) unlink($file);
            }
            echo "Cleared directory: $path\n";
        } else {
            unlink($path);
            echo "Deleted file: $path\n";
        }
    }
}
echo "Manual cache clear complete.";
