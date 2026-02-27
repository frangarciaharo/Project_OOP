<?php


function view(string $template, ?array $data = null)
{
    if (is_array($data)) {
        extract($data);
    }
    require VIEWS . $template . '.view.php';
}
