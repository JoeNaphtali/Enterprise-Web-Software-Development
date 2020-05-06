<?php

if (isset($_POST['download'])) {


    // Get real path for our folder
$rootPath = realpath('../../attachments');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('attachments.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();

// Send the file to the browser as a download
header('Content-disposition: attachment; filename=attachments.zip');
header('Content-type: application/zip');
readfile('attachments.zip');


}