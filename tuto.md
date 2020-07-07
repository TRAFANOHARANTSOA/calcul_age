# Calculer l'age en php
L'objectif de cet exercice est de développer en PHP une peite application qui calcule l'age actuelle de l'utilisateur en fonction de sa date de naissance.

## Le formulaire en  HTML
on commence par générer une balise ```<form>``` et on renseigne le paramètre ```method="post"``` de façon à faire passer l'information renseignée, et on redirige vers une page de traitement en php avec le paramètre ```action=```. Dans ce formulaire, on place deux ```input```, l'un de type ```text``` et l'autre de type ```submit```. On donne une value à ce dernier.

```
<form class="" action="traitement.php" method="post">
  <input type="text" name="" value="">
  <input type="submit" name="" value="envoyer">
</form>
```

##la logique en php
Notre application vas simplement opérer un calcul arithmétique : soustraire l'année de naissance de l'utilisateur à l'année courante.

Pour se faire, on ouvre une balise php, ```<?php``` dans laquelle on déclare une variable «birthdate» en faisant précéder son nom du signe « $ », puis on lui affecte une valeur de type number : la date de naissance du programmeur.

On déclare une seconde variable ```$year``` à laquelle on affecte aussi une valeur de type number : l'année en cours.

On déclare une troisième variable ```$age```, on lui affecte la variable $year suivi de l'arithmétique "-" puis de la variable ```$birthdate```. Enfin on ferme la balise PHP.


## La récupération dynamique des informations.
Dans la  première partie nous avions attribué la method ```post``` à la div ```<form>```, nous allons maintenant récupérer l'information entrée par l'utilisateur dans la page qui fait  le traitement en PHP.

Pour ce faire nous allons utiliser la variable superglobal ```$_POST```. Une superglobale signifie que la variable est disponible dans tous les contextes du script.

```

  $birthdate=$_POST['birthdate'];

```

Nous allons demandés à PHP de récupérer l'année en cours. Utilisons la fontion date() à laquelle nous passions en paramètre la chaine de caractère ```'Y'```.


##Vérification sur le champs de formulaire

On verifie si que la variable superglobal ```$_POST``` paramétrée en utilisant une condition ```if``` à laquelle on passe en paramètre la fonction ```isset()```.

```

if(isset($_POST['birthdate'])){
$birthdate=$_POST['birthdate'];
$year=date('Y');
$age=$year-$birthdate;
echo '<p>vous avez '. $age . ' ans. </p>';
}
else{
  echo"vous n'avez pas écris de date";
}


```
##calcul de l'age exacet (j/m/a)

###modification du html
Dans index.php, on vas changer le type ```text``` de l'input qui sert à récupérer la date de naissance de l'utilisateur en type ```date```.

On vas attribué une value en php qui vas servir à paramétrer le format de la date :
```
  <input type="date" name="birthdate" value="<?php echo date('d-m-Y');?>">

```
### Le traitement
On vas créer une nouvelle fonction qu'on appelle «calcul_age()» :

```
function calcul_age(){};

```
Dans cette fonction, la première chose qu'on vérifie, c'est la présence d'une valeur dans la variable la superglobale ```$_POST```. Pour ce faire, on passe en paramètre la fonction ```isset()``` qui prend elle même ```$_POST + name de l'input``` en paramètre. La fonction isset vérifie si une variable est considérée définie. Si il n' y a rien en ```$_POST```, message d'erreur.

```
  if(isset($_POST['birthdate'])){
  //on vas taper notre code ici -->
  }

  else{
  echo "<p> Vous n'avez pas écris de date.</p>";
  }

```
Maintenant, on vas convertir le contenu de la variable superglobale ```$_POST``` qui est au format chaine de caractère en une valeur au format timestamp.
Le timestamp désigne le nombre de secondes écoulées depuis le 1er janvier 1970 à minuit UTC précise.

Pour ce faire, on redéfinie le contenu de ```$birthdate``` en utilisant la fonction ```strtotime()``` à laquelle on passe en paramètre ```$_POST```:

```
    $birthdate=strtotime($_POST['birthdate']);
```
L'objectif est de comparer le jour, le mois, l'année de naissance à la courante (j/m/a). On déclare trois nouvelles variables: ``` $day_birthdate, $month_birthdate, $year_birthdate``` auxquelles on vas affecter la fonction ```date()``` à laquelle on passe en paramètre le format du jour, mois, année de type int récupérer dans la variable qui contient la date au format ```timestamp```:

```
$day_birthdate=date('d', $birthdate);
$month_birthdate=date('m', $birthdate);
$year_birthdate=date('Y', $birthdate);

```
De la même façon, on va déclarer 3 variables qui vont contenir la fonction date avec en paramètre les options de jours, mois et année :

```
$day_today=date('d');
$month_today=date('m');
$year_today=date('Y');
```
Il nous reste à faire le traitement. On créer une condition qui vas comparer le jour de naissance et mois de naissance au jour et au mois courant. Si le jour et mois de naissance sont respectivement supérieur ou égal au jour et au mois courant alors on déclare une variable ```$age```, qui contient la soustraction de l'année de naissance à l'année actuelle moins 1. Sinon la même variable age vient seulement de la soustraction à l'année de courante à l'année de naissance :
```
  if($day_birthdate>$day_today && $month_birthdate >= $month_today){ $age=($year_today-$year_birthdate)-1; }

```
Enfin, à l'extérieur de la fonction ```calcul_age()``` on appel cette fonction :
```
calcul_age();
```
## Le code complet
### Le html
```
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
<form class="" action="traitement2.php" method="post">
  <input type="date" name="birthdate" value="<?php echo date('d-m-Y');?>">
  <input type="submit" name="" value="envoyer">
</form>

  </body>
</html>

```
### Le PHP
```
<?php function calcul_age(){
  if(isset($_POST['birthdate'])){
    $birthdate=strtotime($_POST['birthdate']);
    // var_dump($_POST['birthdate']);
    // var_dump($birthdate);
    $day_birthdate=date('d', $birthdate);
    $month_birthdate=date('m', $birthdate);
    $year_birthdate=date('Y', $birthdate);
    $day_today=date('d');
    $month_today=date('m');
    $year_today=date('Y');

    // var_dump($day_birthdate);

    if($day_birthdate>$day_today && $month_birthdate >= $month_today){ $age=($year_today-$year_birthdate)-1; }

    else {$age=($year_today-$year_birthdate)}

    else{
    echo "<p> Vous n'avez pas écris de date.</p>";
  }

    echo "vous avez" .$age. "ans";
  }
}
calcul_age();

```
