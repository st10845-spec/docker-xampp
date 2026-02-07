


<?php

//stampa pippo
$a="pippo";
$pippo ="ciao";
echo $$a;

//  stampa cdef
$a= "b";
$b= "c";
$c= "d";
$d= "e";
$e= "f";
echo $$a;
echo $$$a;
echo $$$$a;
echo $$$$$a;
//echo $$$$$$a;

//stampa cdefciao
$a= "b";
$b= "c";
$c= "d";
$d= "e";
$e= "f";
echo $$a;
echo $$$a;
echo $$$$a;
echo $$$$$a;
if($$$$$$a="1")
	echo "ciao";

//CONCATENAZIONE 
$A="ciao";
$B="mondo";
echo $A. $B;

//interpolazione 
$username="nicola";
$password="ciaociao";

$query= "SELECT* FROM utenti WHERE '$username' AND password='$password'";
echo $query;

/*pulire le cose che provengono dall' utente si usano 
htmlspecialchars(
    string $string,
    int $flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401,
    ?string $encoding = null,
    bool $double_encode = true
): string

