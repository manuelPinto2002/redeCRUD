<?php
function ValidarForm(){

    $validacao = array();
    foreach ($_POST as $key => $value)
     if(empty($_POST [$key]))
         $array_push($validacao,$key);
     return $validacao;
   }