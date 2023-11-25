<!-- submit_form.php -->
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email address
    $email = $_POST["email"];

    // Validate the email address (you can perform more validation if needed)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Write email to CSV file
        $csvFile = 'database.csv';
        $file = fopen($csvFile, 'a'); // 'a' opens the file for writing only, creates it if it doesn't exist

        // Write the email to the CSV file
        fputcsv($file, array($email));

        fclose($file);

        // Redirect to thank you page
        header("Location: https://www.jevinta.com/thankyou.html");
        exit();
    } else {
        echo "Invalid email address";
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: index.html");
    exit();
}
?>