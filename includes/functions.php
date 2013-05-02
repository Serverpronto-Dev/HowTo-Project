<?php


//Verify that a string is not empty
function isNotEmpty($input) 
{
    $strTemp = $input;
    $strTemp = trim($strTemp);

    if(strTemp !== ' ') 
    {
         return true;
    }
    return false;
}




?>
