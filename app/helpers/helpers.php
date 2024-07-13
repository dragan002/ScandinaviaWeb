<?php

function renderView($view, $data = []) 
{
    extract($data);
    include($view);
}