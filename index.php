<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

<div class="">
  Renseigner votre date de naissance.
</div>
<form class="" action="traitement.php" method="post">
  <input type="date" name="birthdate" value="<?php echo date('d-m-Y');?>">
  <input type="submit" name="" value="envoyer">
</form>

  </body>
</html>
