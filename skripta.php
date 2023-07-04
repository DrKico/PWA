<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rezultat unosa</title>
    <link rel="stylesheet" href="style.css?v=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <div class="header">
            <h1>BZ</h1>
        </div>
        <nav>
            <ul>
                <li><a class="nav-btn" href="pocetna.php">Home</a></li>
                <li><a class="nav-btn" href="sport.php">Berlin-Sport</a></li>
                <li><a class="nav-btn" href="kultura.php">Kulut und Show</a></li>
                <li><a class="nav-btn" href="administracija.php">Administacija</a></li>
                <li><a class="nav-btn" href="unos.html">Unos</a></li>
            </ul>
        </nav>
    </header>
    <?php
    include 'connect.php';
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $naslov = $_POST["title"];
        $kratki_sadrzaj = $_POST["about"];
        $sadrzaj = $_POST["content"];
        $kategorija = $_POST["category"];
        $arhiva = isset($_POST["archive"]) ? "Da" : "Ne";

        // File upload handling
        if (isset($_FILES["pphoto"]) && $_FILES["pphoto"]["error"] === 0) {
            $slika = $_FILES["pphoto"]["name"];
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], "uploads/" . $slika);
            $slika_url = "uploads/" . $slika;
        } else {
            $slika = "Nije odabrana slika";
            $slika_url = "";
        }
        $query = "INSERT INTO projektpwa (naslov, sazetak, tekst, slika, kategorija, arhiva) 
          VALUES ('$naslov', '$kratki_sadrzaj', '$sadrzaj', '$slika', '$kategorija', '$arhiva')";
        $result = mysqli_query($dbc, $query) or die('Error querying database.');

        // Displaying the submitted data
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-lg-12">';
        echo "<h1>$naslov</h1>";
        if (!empty($slika_url)) {
            echo "<img src=\"$slika_url\" alt=\"Slika\">";
        }
        echo "<b>$kratki_sadrzaj</b>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<p>$sadrzaj</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>Nema podataka za prikaz.</p>";
    }
    ?>
    
    <footer>
        <div class="container">
            <p>Weitere Online-Angebote der Axel Springer SE</p>
        </div>
    </footer>
</body>
</html>
