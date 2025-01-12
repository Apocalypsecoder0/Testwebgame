<?php
/*
 * PHP GD Dynamic Progress Bar Image Script
 * Copyright 2003, B. Johannessen <bob@db.org>
 */

$style_dir = '/path/to/your/styles/';
$styles = array('solaris');

if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = parse_url($_SERVER['HTTP_REFERER']);
    if ($referer['host'] != $_SERVER['HTTP_HOST']) {
        error('403 Forbidden', 'This script only allows links from ' . $_SERVER['HTTP_HOST']);
    }
}

$style = "solaris";
$width = 480;
$done = isset($_GET['prog']) ? (int)$_GET['prog'] : 0;
$total = 200;

if (($width < 64) || ($width > 1280) || ($total < 1) || ($done < 0) || ($done > $total)) {
    error('500 Internal Server Error', 'Value out of range');
}

if (!in_array($style, $styles)) {
    error('500 Internal Server Error', 'Invalid Style');
}

$bg = @imagecreatefrompng($style_dir . 'solaris-bg.png');
$fill = @imagecreatefrompng($style_dir . 'solaris-fill.png');
$bg_cap = @imagecreatefrompng($style_dir . 'solaris-bg-cap.png');
$fill_cap = @imagecreatefrompng($style_dir . 'solaris-fill-cap.png');

if (!$bg || !$fill || !$bg_cap || !$fill_cap) {
    error('503 Service Unavailable', 'Error reading fragments');
}

$fill_width = round((($width - imagesx($bg_cap)) * $done) / $total) - imagesx($fill_cap);

$image = imagecreatetruecolor($width, imagesy($bg));
imagecopy($image, $bg, 0, 0, 0, 0, imagesx($bg), imagesy($bg));
imagecopy($image, $bg_cap, $width - imagesx($bg_cap), 0, 0, 0, imagesx($bg_cap), imagesy($bg_cap));
imagecopy($image, $fill, 0, 0, 0, 0, $fill_width, imagesy($fill));
imagecopy($image, $fill_cap, $fill_width, 0, 0, 0, imagesx($fill_cap), imagesy($fill_cap));

header("Content-Type: image/png");
imagepng($image);

imagedestroy($bg);
imagedestroy($fill);
imagedestroy($bg_cap);
imagedestroy($fill_cap);
imagedestroy($image);

function error($code, $desc) {
    header($_SERVER['SERVER_PROTOCOL'] . ' ' . $code);
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<!DOCTYPE html><html lang="en"><head><title>' . $code . '</title></head><body><h1>' . $code . '</h1><p>' . $desc . '</p></body></html>';
    exit;
}
?>
