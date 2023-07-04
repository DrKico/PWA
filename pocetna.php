<!DOCTYPE html>
<html>  
<head>
    <link rel="stylesheet" href="style.css?v=5">
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
                <li><a class="nav-btn" href="registracija.php">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="orange" >BERLIN-SPORT</div>
        </div>
        <div class="row">
            <?php
            $i = 0;
            define('UPLPATH', 'uploads/');
            include 'connect.php';
            $query = "SELECT * FROM projektpwa WHERE kategorija = 'Sport' AND arhiva = 0 ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $naslov = $row['naslov'];
                $sazetak = $row['sazetak'];
                $slika = $row['slika'];
                if ($i % 3 === 0 && $i !== 0) {
                    echo '</div>';
                    echo '<div class="row">'; 
                }
            
                echo '<div class="col-lg-4">';
                echo '<img src="' . UPLPATH . $row['slika'] . '">';
                echo '<h4><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h4>';
                echo '</div>';
            
                $i++;
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-12" id="red" >KULTUR UND SHOW></div>
        </div>
        <div class="row">
            <?php

            $query = "SELECT * FROM projektpwa WHERE kategorija = 'kultura' AND arhiva = 0 ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($dbc, $query);
 
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $naslov = $row['naslov'];
                $sazetak = $row['sazetak'];
                $slika = $row['slika'];
                if ($i % 3 === 0 && $i !== 0) {
                    echo '</div>';
                    echo '<div class="row">'; 
                }
            
                echo '<div class="col-lg-4">';
                echo '<img src="' . UPLPATH . $row['slika'] . '">';
                echo '<h4><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h4>';
                echo '</div>';
            
                $i++;
            }
            ?>
        </div>
    </div>
    <footer>
        <div class="container">
            <p>Weiltere Online-Angebotr der Axel Springer SE</p>
        </div>
    </footer>
</body>
</html>
