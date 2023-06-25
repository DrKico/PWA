<?php
include 'connect.php';


if($_SERVER["REQUEST_METHOD"] =="POST"){
$picture = $_FILES['pphoto']['name'];
$title = $_POST['title'];
$about = $_POST['about'];
$content = $_POST['content'];
$category = $_POST['category'];

if (isset($_POST['archive'])) {
    $archive = 1;
} else {
    $archive = 0;
}

$target_dir = 'uploads/' . $picture;
move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

$query = "INSERT INTO projektpwa (naslov, sazetak, tekst, slika, kategorija, arhiva) 
          VALUES ('$title', '$about', '$content', '$picture', '$category', '$archive')";
$result = mysqli_query($dbc, $query) or die('Error querying database.');
}
?>

<!DOCTYPE html>
<html>  
<head>
    <link rel="stylesheet" href="style.css?v=4">
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
    <div class="center">
    <form action="skripta.php" method="POST" enctype="multipart/form-data">
        <div class="form-item">
            <label for="title">Naslov vijesti</label>
            <div class="form-field">
                <input type="text" name="title" class="form-field-textual">
            </div>
        </div>
        <div class="form-item">
            <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
            <div class="form-field">
                <textarea name="about" id="" cols="30" rows="10" class="formfield-textual"></textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="content">Sadržaj vijesti</label>
            <div class="form-field">
                <textarea name="content" id="" cols="30" rows="10" class="form-field-textual"></textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="pphoto">Slika: </label>
            <div class="form-field">
                <input type="file" accept="image/jpg,image/gif" class="input-text" name="pphoto" />
            </div>
        </div>
        <div class="form-item">
            <label for="category">Kategorija vijesti</label>
            <div class="form-field">
                <select name="category" id="" class="form-field-textual">
                    <option value="sport">Sport</option>
                    <option value="kultura">Kultura</option>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label>Spremiti u arhivu:
                <div class="form-field">
                    <input type="checkbox" name="archive">
                </div>
            </label>
        </div>
        <div class="form-item">
            <button type="reset" value="Poništi">Poništi</button>
            <button type="submit" value="Prihvati">Prihvati</button>
        </div>
    </form>
    </div>
    <footer>
        <div class="container">
            <p>Weiltere Online-Angebotr der Axel Springer SE</p>
        </div>
    </footer>
</body>
</html>
