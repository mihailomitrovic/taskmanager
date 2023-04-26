<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <nav class = "nav">
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

    <div class="nav2" id="myTopnav">
        <a href="glavna.php" class="aktivan"><img src="../slike/logo.svg" id="logo"></a>
        <a class="neaktivan" href="dodaj.php">Unos</a>
        <a class="neaktivan" href="izmeni.php">Izmena</a>
        <a class="neaktivan" href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "nav2") {
            x.className += " responsive";
        } else {
            x.className = "nav2";
        }
    }
</script>

</body>
</html>

<!--

<nav class = "nav">
        <div id="logocontainer_nav">
            <a href="glavna.php"><img src="./slike/logo.svg" id="logo"></a>
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

-->
