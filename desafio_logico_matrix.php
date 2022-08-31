<?php
  
$valor1 = array(
			array(1, 2, 3),
			array(4, 5, 6),
			array(9, 8, 9)
		);

$principal = 0;
$secundaria = 0; 
$n = 3;

	for ($i=0; $i <$n ; $i++) { 


		for ($j=0; $j <$n; $j++) { 

			if($i == $j){

				$principal += $valor1[$i][$j];
				
			}		
     
		}
		
	}


   
    for ($i = 0; $i < $n; $i++) {

    	// print_r($valor1[$i][$n - $i - 1]);
        
        $secundaria += $valor1[$i][$n - $i - 1]; 
    }
    	$diferença = $principal - $secundaria;
		echo "<pre>";
			print_r("A diagonal Principal= ".$principal);
	        echo "<br>";
	        print_r("A diagonal Secundaria= ".$secundaria);
			echo "<br>";
	        print_r("A diferença entre elas é= ".$diferença);
		echo "</pre>";

	
    
?>
