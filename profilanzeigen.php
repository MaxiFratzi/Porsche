<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>AJAX</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    </head>
    <body >
        <h1>Benutzer Anzeigen:</h1>
        <form>
            <label>Benutzer-Nummer eingeben:</label>
            <input type="number" id="id">
            <!-- Button zum Absenden des Request:
             Wenn auf den Button geklickt wird, wird die JavaFunktion
             show_benutzer() aufgerufen -->
            <input type="button" value="Benutzer anzeigen" onclick="show_benutzer()">
        </form>
        <hr>
        <h1>Benutzerinfo:</h1>
        <div id='benutzerdiv'>Hier kommen die Info rein
        </div>
        
        <script>
            // JavaScript Teil: wird im Web Client ausgeführt !!!
            // ====================================================
            // Absenden eines AJAX Requests
            // Parameter: id = Themengebiet ID
            // Die Funktion wird aufgerufen, wenn ein Themengebiet angeklickt wird  

            
            function show_benutzer() {
                // Eingabefeld für BenutzerNummer holen
                // getElementById liefert das Element mit der ID "benutzerid"
                // value liefert den Inhalt des Elements
                let eingabe= document.getElementById("id");
                let id = eingabe.value;
                 
                // Hier gehts los: Wir erzeugen ein Objekt vom Typ XMLHttpRequest
                // XMLHttpRequest ist ein Objekt, das von Browsern bereitgestellt wird  
                // es ermöglicht den Austausch von Daten mit einem Server
                // ohne dass die Seite neu geladen werden muss
                let x= new XMLHttpRequest();

                // Diese Funktion onreadystatechange wird bei Statusänderung
                // des Requests aufgerufen
                x.onreadystatechange = function() {
                    // readyState 4 bedeutet, dass die Antwort vollständig ist
                    // status == 200 Wenn der Request erfolgreich war:
                    if (this.readyState == 4) {
                         // Status 200 bedeutet, dass alles OK ist
                        if (this.status == 200) {
                            // Hier wird der Response Text in das DIV geschrieben
                            // das mit der ID "benutzerdiv" identifiziert wird
                            let element = document.getElementById("benutzerdiv");
                            // in das Element wird der Response Text geschrieben
                            element.innerHTML = this.responseText;
                        } else {                            
                            // Wenn der Request nicht erfolgreich war:
                            // Fehlermeldung
                            alert("Fehler beim Laden des Benutzers: " + 
                                   this.status + " " + this.responseText);
                        }
                    }
                }; // Ende der Funktion onreadystatechange

                // Hier wird der Request aufgebaut
                //    1) Methode, 2) URL, 3) asynchroner Modus bei Wert true
                x.open("POST","profillesen.php", true);

                // Definiert das Format der Parameter beim Senden:
                // gleich wie diese innerhalb der URL codiert werden
                x.setRequestHeader("Content-type",
                                   "application/x-www-form-urlencoded");

                // Senden der Anfrage mit parameter id
                // Name des Parameters: der String: "id", 
                // Wert des Parameters: der Inhalt der Variablen id (= Benutzer ID)
                x.send("id="+id);
            }

        </script>
    </body>
</html>