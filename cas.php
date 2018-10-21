<?php
/* ------ exemple de client CAS écrit en PHP --------*/ 
  // localisation du serveur CAS
 define('CAS_BASE','https://cas.utc.fr'); 
  // propre URL 
 $service = 'www.heymanpierrick.ddns.net/cas.php'; 
/** Cette simple fonction réalise l’authentification CAS. 
   * @return  le login de l’utilisateur authentifié, ou FALSE. 
   */ 


// récupération du ticket (retour du serveur CAS) 
      if (!isset($_GET['ticket']))  // pas de ticket : on redirige le navigateur web vers le serveur CAS 
      {  	header('Location: https://cas.utc.fr/cas/?service=http://heymanpierrick.ddns.net/cas.php'); 
       		exit() ;  
      } 

//echo $_GET['ticket'].'<br>';
$ticket = $_GET['ticket'];
//echo 'https://cas.utc.fr/cas/serviceValidate?service=http://heymanpierrick.ddns.net/cas.php&ticket=' . $_GET['ticket'] . '<br><br>';

// un ticket a été transmis, on essaie de le valider auprès du serveur CAS
$fpage = fopen ('https://cas.utc.fr/cas/serviceValidate?service=http://heymanpierrick.ddns.net/cas.php&ticket=' . $_GET['ticket'],  'r');       

if ($fpage) 
{ 
	while (!feof ($fpage)) 
	{ 
		$page .= fgets ($fpage, 1024); 	
//		echo htmlEntities($page).'<br>';
	} 
//	echo 'dans premier if <br>';
// analyse de la réponse du serveur CAS
        if (preg_match('|<cas:authenticationSuccess>.*</cas:authenticationSuccess>|mis',$page)) 
	{
		echo 'Login : '; 
		 if(preg_match('|<cas:user>(.*)</cas:user>|',$page,$match))
                {
                        echo $match[1] . '<br>';
			global $login;
			$login = $match[1];
                }
		
		echo 'Prénom et nom : ';
		 if(preg_match('|<cas:displayName>(.*)</cas:displayName>|',$page,$match))
                {
                        echo $match[1] . '<br>';

                }

		echo 'Adresse mail : ';
                 if(preg_match('|<cas:mail>(.*)</cas:mail>|',$page,$match))
                {
                        echo $match[1] . '<br>';

                }


		echo 'Photo : <br>';

		if(preg_match('|<cas:user>(.*)</cas:user>|',$page,$match))
		{ 
			//echo $match[1];
			//echo ' src="https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur?username=' . $match[1] . '">';
			echo '<img src="https://demeter.utc.fr/portal/pls/portal30/portal30.get_photo_utilisateur?username=' . $match[1] . '">';

                } 
          } 
} 
// problème de validation
 
//echo '<br>bonjourbis';

  //$login = authenticate(); 
  //if ($login === FALSE ) { 
    //  echo 'Requête non authentifiée (<a href="'.$service.'"><b>Recommencer</b></a>).'; 
      //exit() ; 
// à ce point, l’utilisateur est authentifié
echo '<br><br>';
//echo $login;
echo '<br><br><a href="https://cas.utc.fr/cas/logout">Déconnexion</a>';
?>

