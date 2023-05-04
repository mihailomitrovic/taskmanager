<?php

require("../stranice/glavna.php");

session_destroy();
header("Location:index.php");