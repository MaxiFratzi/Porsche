<?php
// Request Parameter mit Namen "id" auslesen
// und cast für integer
$id = (int) $_REQUEST["id"];

if (is_int($id)) {  // Absicherung für den Wert für $id: muss eine Integer Zahl sein
             
    // bitte die Parameterwerte anpassen: 
    // 1)host:port, 2)user, 3)passwort, 4)datenbank
    // connection herstellen   
    $connection = new mysqli("localhost", "root", "root", "newsporsche");
    if ($connection->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $connection->connect_error);
    } 
        
    // Daten auslesen und in HTML-Form ausgeben
    // für $id habe ich sichergestellt, dass es ein Integer Wert ist,
    // somit geht das "Anhängen"ok - keine SQL Injection
    $sql =     "SELECT * FROM users WHERE id = ?"; 
    // SQL Statement ausführen, dieses mal ohne prepare ($id ist ja nur ein Integer Wert)
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    // resultset holen  
    $resultset = $statement->get_result();
    // resultset durchlaufen und:
    while ($row=$resultset->fetch_assoc()) {
        // Spalten auslesen
        $id=$row["id"];
        $email=$row["email"];
        $password=$row["password"]; 

        // Erzeugung der Antwort
        echo "<p>Benutzer-id: $id</p>\n";
        echo "<p>Email: $email</p>\n";
        echo "<p>Passwort: $password</p>\n";
    }
    $statement->close();
    $connection->close();
} else {
    echo "Fehler: ID ist kein Integer Wert";
}
?>