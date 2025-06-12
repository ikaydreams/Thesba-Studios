<?php
$host = 'localhost';
$dbname = 'thesba_db';
$username = 'root';
$password = ''; // Blank for default XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $artist_name = $_POST['artist_name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $stmt = $pdo->prepare("INSERT INTO contact_submissions (artist_name, email, subject, message) VALUES (:artist_name, :email, :subject, :message)");
        $stmt->bindParam(':artist_name', $artist_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

        echo "Submission successful!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>