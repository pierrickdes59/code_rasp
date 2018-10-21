<!doctype html>
<html lang="sv">
<head>
 <meta charset="utf-8">
 <title>Miroir connect&eacute;</title>
 <meta name="description" content="Miroir connect&eacute;">
 <meta http-equiv="refresh" content="600" /> <!-- La page se recharge toutes les 10 minutes (toutes les 600 secondes) -->
 <link rel="stylesheet" href="style.css?<?php echo timestamp; ?>">
 <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
  <script language="JavaScript"> <!-- Chaque seconde l'heure et la date sont mises à jour -->
   setInterval(function() { 
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );   
    var currentMinutes = currentTime.getMinutes ( );
    var currentMinutesleadingzero = currentMinutes > 9 ? currentMinutes : '0' + currentMinutes; // Si le nombre est inférieur ou égal à 9 on ajoute un 0 devant.
    var currentDate = currentTime.getDate ( );
 
     var weekday = new Array(7);
     weekday[0] = "Dimanche";
     weekday[1] = "Lundi";
     weekday[2] = "Mardi";
     weekday[3] = "Mercredi";
     weekday[4] = "Jeudi";
     weekday[5] = "Vendredi";
     weekday[6] = "Samedi";
    var currentDay = weekday[currentTime.getDay()]; 
 
     var actualmonth = new Array(12);
     actualmonth[0] = "Janvier";
     actualmonth[1] = "Fevrier";
     actualmonth[2] = "Mars";
     actualmonth[3] = "Avril";
     actualmonth[4] = "Mai";
     actualmonth[5] = "Juin";
     actualmonth[6] = "Juillet";
     actualmonth[7] = "Ao&ucirc;t";
     actualmonth[8] = "Septembre";
     actualmonth[9] = "Octobre";
     actualmonth[10] = "Novembre";
     actualmonth[11] = "Decembre";
    var currentMonth = actualmonth[currentTime.getMonth ()];
    var currentTimeString = "<h1>" + currentHours + ":" + currentMinutesleadingzero + "</h1><h2>" + currentDay + " " + currentDate + " " + currentMonth + "</h2>";
    document.getElementById("clock").innerHTML = currentTimeString;
}, 1000);
 </script>
</head>
<body>
<div id="wrapper">
 <div id="upper-left">
  <div id="clock"></div> <!-- Inclus le script date/heure -->
 </div>
 <div id="upper-right">
  <h2>...</h2>
  <?php // Code pour le flux d'infos RSS
   $rss = new DOMDocument();
   $rss->load('http://www.lemonde.fr/rss/une.xml'); // Adresse du flux (ici la "une" du journal "Le Monde" France)
   $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
     $item = array (
     'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
     'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
     'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
     );
    array_push($feed, $item);
    }
   
  $limit = 3; // Nombre d'articles à afficher
   for($x=0;$x<$limit;$x++) {
    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
    $description = $feed[$x]['desc'];
    $date = date('j F', strtotime($feed[$x]['date']));
    echo '<h2 class="smaller">'.$title.'</h2>';
    echo '<p class="date">'.$date.'</p>';
    echo '<p>'.strip_tags($description, '<p><b>').'</p><h2>...</h2>';
   }
  ?>
 </div>
<!-- widget meteo -->
<div id="meteo">
<div id="cont_NjAxNTl8M3wxfDF8NHwwMDAwMDB8MXxGRkZGRkZ8Y3wx">
  <div id="spa_NjAxNTl8M3wxfDF8NHwwMDAwMDB8MXxGRkZGRkZ8Y3wx">
    <a id="a_NjAxNTl8M3wxfDF8NHwwMDAwMDB8MXxGRkZGRkZ8Y3wx" href="http://www.meteocity.com/france/compiegne_v60159/" target="_blank" style="color:#333;text-decoration:none;">Météo Compiègne</a>
  </div>
<script type="text/javascript" src="http://widget.meteocity.com/js/NjAxNTl8M3wxfDF8NHwwMDAwMDB8MXxGRkZGRkZ8Y3wx">
</script>
</div>
</div>
<!-- widget meteo -->
 <div id="bottom">
  <h3>
  <?php 
   $now = date('H');
    if (($now > 06) and ($now < 10)) echo 'Bonjour !';
    else if (($now >= 10) and ($now < 12)) echo 'Passez une bonne journ&eacute;e !';
    else if (($now >= 12) and ($now < 14)) echo 'A table !';
    else if (($now >= 14) and ($now < 17)) echo 'Vous &ecirc;tes magnifique !';
    else if (($now >= 17) and ($now < 20)) echo 'On mange quoi ce soir ?';
    else if (($now >= 20) and ($now < 22)) echo 'Bonne soir&eacute;e !';
    else if (($now >= 22) and ($now <= 23)) echo 'Bonne nuit, &agrave; demain !';
    else if (($now >= 00) and ($now <= 06)) echo 'Zzzzzzzz...';
   ?>
  </h3>
 </div>
</div>
</body>
</html>
