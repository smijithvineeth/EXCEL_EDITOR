<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dropdown'])) {
    // Specify the temporary file path
    $tempFilePath = 'uploads/original.xlsx'; // Adjust to match the path used in process.php

    // Load the original Excel file from the temporary location
    $spreadsheet = IOFactory::load($tempFilePath);
    $worksheet = $spreadsheet->getActiveSheet();

    // Get the user-edited data (dropdown values)
    $editedData = $_POST['dropdown'];

    // Calculate the column index for the new column (end of original data)
    $columnIndex = count($worksheet->toArray()[0]) + 1;

    // Iterate through the edited data and set it in the corresponding column
    foreach ($editedData as $rowIndex => $editedValue) {
        $rowIndex++; // Adjust to start from row 1
        $cell = $worksheet->getCellByColumnAndRow($columnIndex, $rowIndex);
        $cell->setValue($editedValue);
    }

    // Save the modified Excel file
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $newFileName = 'modified_data.xlsx'; // Specify a new file name
    $writer->save($newFileName);

    // Provide a download link for the new Excel file
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $newFileName . '"');
    readfile($newFileName);

    // Clean up the temporary file
    unlink($tempFilePath);
} else {
    echo 'No data to save.';
}
