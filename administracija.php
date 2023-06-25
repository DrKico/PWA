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
        <?php 
    include 'connect.php';
    define('UPLPATH', 'uploads/');
    $query = "SELECT * FROM projektpwa";
    $result = mysqli_query($dbc, $query);
    while($row = mysqli_fetch_array($result)) {

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
    ?>
    </div>
    <footer>
        <div class="container">
          <p>Weiltere Online-Angebotr der Axel Springer SE</p>
        </div>
    </footer>
      
</body>
</html>



