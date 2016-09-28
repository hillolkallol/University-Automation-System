<?php

echo section(3);
	
function section($number){
	
    switch($number){
        case 0: return '';
        break;
        
        case 1: return '';
        break;
        
        case 2: return 'A,B';
        break;
        
        case 3: return 'A,B,C';
        break;
        
        case 4: return 'A,B,C,D';
        break;
        
        case 5: return 'A,B,C,D,';
        break;
    }
 
}


?>