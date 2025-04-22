<?php
//create function with an exception
function checkNum($number)
{
    if ($number > 1) {
        $a = new Exception("Dừng lại điđi");
        // throw new Exception("Value must be 1 or below");
        print_r($a->getMessage());
    }
    return true;
}

//trigger exception
// checkNum(2);
