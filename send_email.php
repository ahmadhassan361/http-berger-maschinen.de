<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firma = htmlspecialchars($_POST["firma"]);
    $anrede = htmlspecialchars($_POST["anrede"]);
    $vorname = htmlspecialchars($_POST["vorname"]);
    $nachname = htmlspecialchars($_POST["nachname"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $betreff = htmlspecialchars($_POST["betreff"]);
    $kommentar = htmlspecialchars($_POST["kommentar"]);

    // Validate required fields
    if (empty($anrede) || empty($vorname) || empty($nachname) || empty($email) || empty($betreff)) {
        die("Fehler: Bitte füllen Sie alle Pflichtfelder aus.");
    }

    // Email content
    $to = "ahmadpisces2000@gmail.com"; // Change to your email
    $subject = "Neue Nachricht von $vorname $nachname - $betreff";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $message = "Firma: $firma\n";
    $message .= "Anrede: $anrede\n";
    $message .= "Vorname: $vorname\n";
    $message .= "Nachname: $nachname\n";
    $message .= "E-Mail: $email\n";
    $message .= "Telefon: $telefon\n";
    $message .= "Betreff: $betreff\n";
    $message .= "Nachricht:\n$kommentar\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Redirect after successful email sending
        header("Location: kontaktformular.html");
        exit();
    } else {
        echo "Fehler beim Senden der E-Mail.";
    }
} else {
    echo "Ungültige Anfrage.";
}
?>
