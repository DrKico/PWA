<?php
session_start();
include 'connect.php';

// Putanja do direktorija sa slikama
define('UPLPATH', '');
$uspjesnaPrijava=false;
// Provjera da li je korisnik došao s login forme
if (isset($_POST['prijava'])) {
    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);

    // Provjera lozinke
    if (crypt($_POST['lozinka'], $lozinkaKorisnika) == $lozinkaKorisnika && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;

        // Provjera da li je admin
        if ($levelKorisnika == 1) {
            $admin = true;
        } else {
            $admin = false;
        }

        // Postavljanje session varijabli
        $_SESSION['$username'] = $imeKorisnika;
        $_SESSION['$level'] = $levelKorisnika;
    } else {
        $uspjesnaPrijava = false;
    }
}

// Odjava korisnika
if (isset($_POST['odjava'])) {
    // Brisanje session varijabli
    session_unset();
    session_destroy();
}

// Brisanje i promjena arhiviranosti
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
    var title = document.forms["myForm"]["title"].value;
    var about = document.forms["myForm"]["about"].value;
    var content = document.forms["myForm"]["content"].value;
    var pphoto = document.forms["myForm"]["pphoto"].value;
    var category = document.forms["myForm"]["category"].value;

    var isValid = true;

    if (title.length < 5 || title.length > 30) {
      document.forms["myForm"]["title"].style.borderColor = "red";
      isValid = false;
    }

    if (about.length < 10 || about.length > 100) {
      document.forms["myForm"]["about"].style.borderColor = "red";
      isValid = false;
    }

    if (content.trim() === "") {
      document.forms["myForm"]["content"].style.borderColor = "red";
      isValid = false;
    }

    if (pphoto === "") {
      document.forms["myForm"]["pphoto"].style.borderColor = "red";
      isValid = false;
    }

    if (category === "") {
      document.forms["myForm"]["category"].style.borderColor = "red";
      isValid = false;
    }

    if (!isValid) {
      alert("Please fill in the required fields correctly.");
    }

    return isValid;
  }
</script>
  
</head>
<body>
<header>
    <h1 class="title">BZ</h1>
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
<hr>

<?php
// Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username']) && $_SESSION['$level'] == 1)) {
  
  $query = "SELECT * FROM projektpwa";
  $result = mysqli_query($dbc, $query);
  
  while ($row = mysqli_fetch_array($result)) {
    echo '<div class="center">
    <form enctype="multipart/form-data" action="" method="POST">
    <div class="form-item">
    <label for="title">Naslov vjesti:</label>
    <div class="form-field">
    <input type="text" name="title" class="form-field-textual"
    value="'.$row['naslov'].'">
    </div>
    </div>
    <div class="form-item">
    <label for="about">Kratki sadržaj vijesti (do 50
    znakova):</label>
    <div class="form-field">
    <textarea name="about" id="" cols="30" rows="10" class="formfield-textual">'.$row['sazetak'].'</textarea>
    </div>
    </div>
    <div class="form-item">
    <label for="content">Sadržaj vijesti:</label>
    <div class="form-field">
    <textarea name="content" id="" cols="30" rows="10" class="formfield-textual">'.$row['tekst'].'</textarea>
    </div>
    </div>
    <div class="form-item">
    <label for="pphoto">Slika:</label>
    <div class="form-field">
    14
    <input type="file" class="input-text" id="pphoto"
    value="'.$row['slika'].'" name="pphoto"/> <br><img src="' . UPLPATH .
    $row['slika'] . '" width=100px>
    // pokraj gumba za odabir slike pojavljuje se umanjeni prikaz postojeće slike
    </div>
    </div>
    <div class="form-item">
    <label for="category">Kategorija vijesti:</label>
    <div class="form-field">
    <select name="category" id="" class="form-field-textual"
    value="'.$row['kategorija'].'">
    <option value="sport">Sport</option>
    <option value="kultura">Kultura</option>
    </select>
    </div>
    </div>
    <div class="form-item">
    <label>Spremiti u arhivu:
    <div class="form-field">';
    if($row['arhiva'] == 0) {
    echo '<input type="checkbox" name="archive" id="archive"/>
    Arhiviraj?';
    } else {
    echo '<input type="checkbox" name="archive" id="archive"
    checked/> Arhiviraj?';
    }
    echo '</div>
    </label>
    </div>
    <div class="form-item">
    <input type="hidden" name="id" class="form-field-textual"
    value="'.$row['id'].'">
    <button type="reset" value="Poništi">Poništi</button>
    <button type="submit" name="update" value="Prihvati">
    Izmjeni</button>
    <button type="submit" name="delete" value="Izbriši">
    Izbriši</button>
    </div>
    </form>
    </div>';
    }
    if(isset($_POST['delete'])){
        $id=$_POST['id'];
        $query = "DELETE FROM projektpwa WHERE id=$id ";
        $result = mysqli_query($dbc, $query);
    }

    if(isset($_POST['update'])){
    $picture = $_FILES['pphoto']['name'];
    $title=$_POST['title'];
    $about=$_POST['about'];
    $content=$_POST['content'];
    $category=$_POST['category'];
    if(isset($_POST['archive'])){
        $archive=1;
    }else{
        $archive=0;
    }
    $target_dir = 'uploads/' . $picture;
    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    $id=$_POST['id'];
    $query = "UPDATE projektpwa SET naslov='$title', sazetak='$about', tekst='$content',
    slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
  }
  
  mysqli_close($dbc);

    ?>

    <!-- Odjava korisnika -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="odjava">Odjava</button>
    </form>

    <?php
} else if ($uspjesnaPrijava == true && $admin == false) {
    echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    // Omogući ponovni login
    ?>

    <!-- Forma za ponovni login -->
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="lozinka" required><br>

        <button type="submit" name="prijava">Prijava</button>
    </form>

    <?php
} else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
    echo '<p>Bok ' . $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    // Omogući ponovni login
    ?>

    <!-- Forma za ponovni login -->
    <h2>Login</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="lozinka" required><br>

        <button type="submit" name="prijava">Login</button>
    </form>

    <?php
} else if ($uspjesnaPrijava == false) {
    ?>

    <!-- Forma za prijavu -->
    <h2>Login</h2>
    <?php
    if (isset($uspjesnaPrijava) && !$uspjesnaPrijava) {
        echo '<p>Invalid username or password.</p>';
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="lozinka" required><br>

        <button type="submit" name="prijava">Prijava</button>
    </form>

    <?php
}
?>

<footer>
        <div class="container">
            <p>Weiltere Online-Angebotr der Axel Springer SE</p>
        </div>
    </footer>
</body>
</html>
