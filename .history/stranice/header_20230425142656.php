<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <nav class = "nav" id="desktop">
        <div id="logocontainer_nav">
            <a href="glavna.php"><img src="../slike/logo.svg" id="logo"></a>
        </div>
        <ul id="linkovi">
            <li><a href="glavna.php">Pregled</a></li>
            <li><a href="dodaj.php">Unos</a></li>
            <li><a href="izmeni.php">Izmena</a></li>
        </ul>
        <div id="buttoncontainernav">
            <a href="odjava.php"><button class="button" name="button" type="button">Odjavi se</button></a>
        </div>
    </nav>

<script>
function myFunction() {
  var x = document.getElementById("linkovi");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
</body>
</html>