<?php

class Helpers{

    public static function sanear($valor){
        return htmlspecialchars(trim($valor));
    }

}


?>