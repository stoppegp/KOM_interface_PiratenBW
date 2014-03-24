<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $meldung = trim(htmlspecialchars($_POST['meldung']));
    $issue = trim(htmlspecialchars($_POST['issue']));
    if ($issue != 0) {
        $issuetext = KOM::$issuelist[$issue];
    } else {
        $issuetext = "Allgemein";
    }
    
    if ($meldung != "") {
        mail(REPORT_EMAIL, "KOM: Fehler gemeldet", $name."\n".$email."\n\n"."Thema: ".$issuetext."\n\n".$meldung, "From: Kretschmann-O-Meter <kom@piratenpartei-bw.de>");
        $send_success = true;
    }
    
}

?>

<?php

    include('templates/report.php');



?>
