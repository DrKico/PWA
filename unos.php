<?php
date_default_timezone_set('Europe/Paris');

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
    <link rel="stylesheet" href="style.css?v=5">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            var title = document.getElementById("title").value;
            var about = document.getElementById("about").value;
            var content = document.getElementById("content").value;
            var pphoto = document.getElementById("pphoto").value;
            var category = document.getElementById("category").value;

            if (title.length < 5 || title.length > 30) {
                document.getElementById("title").style.borderColor = "red";
                return false;
            }

            if (about.length < 10 || about.length > 100) {
                document.getElementById("about").style.borderColor = "red";
                return false;
            }

            if (content.trim() === "") {
                document.getElementById("content").style.borderColor = "red";
                return false;
            }

            if (pphoto === "") {
                document.getElementById("pphoto").style.borderColor = "red";
                return false;
            }

            if (category === "") {
                document.getElementById("category").style.borderColor = "red";
                return false;
            }
        }
    </script>
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
    <div class="center">
        <form action="skripta.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-item">
                <label for="title">naslov vijesti mora imati 5 do 30 znakova</label>
                <div class="form-field">
                    <input type="text" name="title" class="form-field-textual" id="title">
                </div>
            </div>
            <div class="form-item">
                <label for="about"> kratki sadržaj vijesti mora imati 10 do 100 znakova </label>
                <div class="form-field">
                    <textarea name="about" id="about" cols="30" rows="10" class="formfield-textual"></textarea>
                </div>
            </div>
            <div class="form-item">
                <label for="content">tekst vijesti nesmije biti prazan</label>
                <div class="form-field">
                    <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
                </div>
            </div>
            <div class="form-item">
                <label for="pphoto">slika mora biti odabrana</label>
                <div class="form-field">
                    <input type="file" accept="image/jpg,image/gif" class="input-text" name="pphoto" id="pphoto" />
                </div>
            </div>
            <div class="form-item">
                <label for="category">kategorija mora biti odabrana</label>
                <div class="form-field">
                    <select name="category" id="category" class="form-field-textual">
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

