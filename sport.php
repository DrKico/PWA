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
                <li><a class="nav-btn" href="pocetna.html">Home</a></li>
                <li><a class="nav-btn" href="sport.php">Berlin-Sport</a></li>
                <li><a class="nav-btn" href="kultura.php">Kulut und Show</a></li>
                <li><a class="nav-btn" href="administracija.php">Administacija</a></li>
                <li><a class="nav-btn" href="unos.php">Unos</a></li>
            </ul>
        </nav>
    </header>
<?php
include 'connect.php';
define('UPLPATH', 'uploads/');
?>
<section class="sport">
<?php
$query = "SELECT * FROM projektpwa WHERE arhiva=0 AND kategorija='sport' LIMIT 4";
$result = mysqli_query($dbc, $query);
$i = 0;

echo '<div class="container">';
echo '<div class="row">';

while ($row = mysqli_fetch_array($result)) {
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

echo '</div>'; // Close the last row
echo '</div>'; // Close the container
?>

</section>

    <footer>
        <div class="container">
          <p>Weiltere Online-Angebotr der Axel Springer SE</p>
        </div>
    </footer>
      
</body>
</html>
