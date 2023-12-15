<?php

// funxione per rendere gli item della sidebar attivi al click

function setActive(array $route)
{
    if(is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

// come paramentro la funzione prende come dato un array,
// nella prima condizione verifichiamo che il parametro che arriva dalla funzione sia in array e in quel caso il loop viene eseguito.
// Nell foreach tramite le helpers function di laravel se le rotte su cui facciamo il loop sono presenti nel array avremo come return 'active'.