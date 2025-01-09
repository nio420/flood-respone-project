<?php
// Directory to save uploaded files
$uploadDir = 'uploads/';

// Check if the form is submitted and a file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio'])) {
    $fileName = basename($_FILES['audio']['name']);
    $targetFile = $uploadDir . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['audio']['tmp_name'], $targetFile)) {
        echo "Voice message uploaded successfully.";

        // Save metadata (optional: you can use a database)
        // Example: Save to a JSON file
        $data = [
            'file' => $targetFile,
            'user' => 'Anonymous', // Replace with user info if available
            'timestamp' => date('Y-m-d H:i:s'),
        ];
        file_put_contents('messages.json', json_encode($data) . PHP_EOL, FILE_APPEND);
    } else {
        echo "Error uploading the voice message.";
    }
} else {
    echo "Invalid request.";
}
?>
