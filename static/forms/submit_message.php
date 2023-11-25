<!-- submit_message.php -->
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Validate the email address (you can perform more validation if needed)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Write form data to CSV file
        $csvFile = 'messages.csv';
        $file = fopen($csvFile, 'a'); // 'a' opens the file for writing only, creates it if it doesn't exist

        // Write the form data to the CSV file
        fputcsv($file, array($name, $email, $subject, $message));

        fclose($file);

        // Redirect to the success page
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
