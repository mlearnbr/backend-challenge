<?php

class Matrix
{
    public $right = 0;
    public $left = 0;
    
    /**
     * Get sum
     */
    public function sum($matrix)
    {   
        $j = count($matrix) - 1;
        for($i = 0; $i < count($matrix); $i++):
            $this->right += $matrix[$i][$i];
            $this->left += $matrix[$i][$j];
            $j--;
        endfor;
    }
    
    /**
     * Get substraction
     */
    public function subtraction()
    {
        return $this->right - $this->left;
    }

    /**
     * Return operation results
     */
    public function operation($matrix)
    {
        $this->sum($matrix);

        return $this->subtraction();
    }
}