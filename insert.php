
    <?php
        // PHP-Code: Auslesen der Parameter
        // Überprüfe, ob die Parameter username und password übergeben wurden
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Bitte geben E-Mail und Passwort ein!";
            exit;
        }

        // $_POST ist ein Array, das alle Parameter enthält, die per POST übergeben wurden
        // $_GET ist ein Array, das alle Parameter enthält, die per GET übergeben wurden
        // Alle Variablen un PHP beginnen mit einem Dollarzeichen
        $mail = $_REQUEST['email'];
        $passwd = $_REQUEST['password'];

        // Überprüfe, ob die Parameter leer sind
        if (empty($mail) || empty($passwd)) {
            echo "Bitte geben Sie E-Mail und Passwort ein!";
            exit;
        }

        // Verbindung zur Datenbank herstellen
        //              Servername, Benutzername, Passwort, Datenbankname
        $connection = new mysqli("localhost", "root", "root", "newsporsche");
        // Überprüfe, ob die Verbindung erfolgreich war
        if ($connection->connect_error) {
            // . ist der Concat Operator in PHP, wie das + in Java
            die("Verbindung zur Datenbank fehlgeschlagen: " . $connection->connect_error);
        }

        // SQL-Query: prepare() bereitet das Statement vor. Vorsicht wegen SQL-INJECTION!
        //             ? sind Platzhalter für die Parameter
        $sql="insert into users (email, password) values (?, ?)";
        $stmt = $connection->prepare($sql);
        // bind_param() bindet die Parameter an die Platzhalter
        // Datentypen: s = string, i = integer, d = double, b = blob
        $stmt->bind_param("ss", $mail, $passwd);
        // execute() führt das Statement aus
        $stmt->execute();
        // check the success of the query
        if ($stmt->affected_rows == 1) {
            header("Location: success.html");
        } else {
            header("Location: error.html");
        }

        // get the ID of the last inserted user
        $id = $stmt->insert_id;

        // Schließe das Statement und die Datenbankverbindung
        $stmt->close();
        $connection->close();

        // Alles was wir mit echo ausgeben, kommt in die Antwort des Servers
        echo "Erfolgreich eingefügt! <br>";
        echo "ID: $id <br>";
        echo "E-MAIL: $mail <br>";
        echo "PASSWORD: $passwd <br>";



    ?>
