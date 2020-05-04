<?php

/**
 * Renders template.
 *
 * @param array $data
 */


function render($template, $data = array())
{
    $path = __DIR__ . '/../templates/' . $template . '.php';
    if (file_exists($path))
    {
        extract($data);
        require($path);
    }else{die('el archivo no existe');}
}

function boton($tipo,$titulo,$id)
{
   return '<button class= "button '.$tipo.'" type="button" id='.$id.'> '.$titulo.' </button>';
    
}


function entrainp($titulo,$id,$acepta,$tipo=''){
    
    return '<input  type="file" class="'.$tipo.'" id="'.$id.'" 
    name="'.$id.'" accept="'.$acepta.'"/> <label for="'.$id.'">'.$titulo.'</label>';
}
