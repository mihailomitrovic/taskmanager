<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link href="./style/style.css" rel="stylesheet">
</head>
<body>
    <div id="content">
        <div id="content_index">
            <div id="levo">
                <div id="logocontainer">
                    <a href="index.php" id="logolink"><img src="./slike/logo.svg" id="logo"></a>
                </div>
                <div id="titlecontainer">
                    <h2 class="title">Task</h2>
                    <h2 class="title2">Manager</h2>
                </div>
                <div id="buttonwrapper">
                    <div class="buttoncontainer">
                        <a href="prijava.php"><button class="button" name="button" type="button">Prijava</button></a>
                    </div>
                    <div class="buttoncontainer">
                        <a href="registracija.php"><button class="button2" name="button2" type="button">Registracija</button></a>
                    </div>
                </div>
            </div>
            <div id="desno">
                <svg viewbox="0 0 100 100" preserveAspectRatio="none" class="swirl">
                    <path d="M100,100 L100,10 C25,50 50,75 0,100z" fill="#17161a"/>
                </svg>
            </div>
        </div>
    </div>
</body>
</html>