<?php 

namespace Classes;

class MatrizQuadrada{
   
   private $matriz;
   private $diagonalEsq;
   private $diagonalDir;   
   
   public function __construct(array $matriz){
   	
   	$this->matriz = $matriz;
   	$this->diagonalEsq = 0;
   	$this->diagonalDir = 0; 

   	$this->leituraDiagonalEsquerdo();
   	$this->leituraDiagonalDireito();	
   	   	   
   }

   public function leituraDiagonalEsquerdo():void{
     for ($i=0; $i < count($this->matriz); $i++){   
       $this->calculaDiagonalEsquerdo($this->matriz[$i][$i]);
     }  	
   }

   private function calculaDiagonalEsquerdo($value):void{
   	  $this->diagonalEsq += $value;
   }

   public function leituraDiagonalDireito():void{
   	 
   	 $positionRightSide = 1;

     for ($index=0; $index < count($this->matriz); $index++){ 
       $this->calculaDiagonalDireito(   
         $this->matriz[$index]
               [count($this->matriz) - $positionRightSide]);

       $positionRightSide++; 
     }      
   }

   private function calculaDiagonalDireito($value):void{
     $this->diagonalDir += $value;
   }

   public function getDiferenca():int{
   	return $this->diagonalEsq - $this->diagonalDir;
   }   
}