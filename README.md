# EXCEL_EDITOR
A refrence to edit Excel using php



This PHP script handles the upload of an Excel file, extracts data from it, and displays the data in an HTML table. Additionally, it adds a new column with dropdown menus for each row. Finally, it provides a form to submit the changes made via dropdown selections.

breakdown of the script:

File Upload Handling:

It checks if the request method is POST and if an Excel file named 'excel_file' has been uploaded.
Loading Excel File:

If a file is uploaded, it moves the uploaded file to a temporary location and loads it using the PhpSpreadsheet library.
Extracting Data:

It extracts data from the Excel file, row by row, and stores it in the $data array.
Displaying Data in HTML Table:

It begins an HTML form that will submit to 'save.php' and creates an HTML table to display the data from the Excel file.
Each cell's content from the Excel file is displayed within table cells (<td> tags).
A new column is added for each row with a dropdown menu (<select> tag) containing options 'YES', 'NO', and 'HEHEHEHE'.
Form Submission:

At the end of each row, there's a submit button to save changes made through dropdown selections.
Upon submission, the form data will be sent to 'save.php'.
Error Handling:

It handles errors such as failed file upload or if no file is uploaded.
