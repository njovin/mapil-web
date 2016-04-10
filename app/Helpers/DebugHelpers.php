<?php

function pre_dump( $data, $exit = false )
{
    if ( is_null($data) )
    {
        $value = "{NULL}";
    }
    elseif ( $data === true )
    {
        $value = "{TRUE}";
    }
    elseif ( $data === false )
    {
        $value = "{FALSE}";
    }        
    else
    {
        $value = print_r( $data, true );
    }
    
    $output = "<pre>\n$value</pre>\n";
    echo $output;
    
    if ( $exit )
    {
        exit;
    }
}