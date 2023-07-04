<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css?v=3">
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
                <li><a class="nav-btn" href="unos.php">Unos</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?php
        include 'connect.php';
        define('UPLPATH', 'uploads/');
        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];
            $query = "SELECT * FROM projektpwa WHERE id = $articleId";
            $result = mysqli_query($dbc, $query);
            if ($row = mysqli_fetch_assoc($result)) {
                $naslov = $row['naslov'];
                $sazetak = $row['sazetak'];
                $slika = $row['slika'];
                $tekst = $row['tekst'];
        ?>
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo $naslov; ?></h1>
                <b><?php echo $sazetak; ?></b>
                <img src="<?php echo UPLPATH . $slika; ?>">
                <p><?php echo $tekst; ?></p>
            </div>
        </div>
        <?php
            } else {
                echo "Article not found!";
            }
        } else {
            echo "Invalid article ID!";
        }
        ?>
    </div>
    <footer>
        <div class="container">
            <p>Weiltere Online-Angebotr der Axel Springer SE</p>
        </div>
    </footer>
</body>
</html>
