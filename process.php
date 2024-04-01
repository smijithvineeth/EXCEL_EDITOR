<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    // Handle file upload
    $file = $_FILES['excel_file']['tmp_name'];
    $tempFilePath = 'uploads/original.xlsx'; // Specify a temporary file path

    // Move the uploaded file to the temporary location
    if (move_uploaded_file($file, $tempFilePath)) {
        // Load the uploaded Excel file
        $spreadsheet = IOFactory::load($tempFilePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = [];

        // Extract data from Excel
        foreach ($worksheet->toArray() as $row) {
            $data[] = $row;
        }

        // Display data in an HTML table with a new column for dropdowns
        echo '<form action="save.php" method="post"><table border="1">';
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . $cell . '</td>';
            }
            // Add a new column for dropdowns in each row
            echo '<td><select name="dropdown[]">
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                    <option value="HEHEHEHE">HEHEHEHE</option>
                    </select></td>';
            echo '</tr>';
        }
        echo '</table><input type="submit" value="Save Changes"></form>';

    } else {
        echo 'Failed to move the uploaded file.';
    }
} else {
    echo 'Please upload an Excel file.';
}
