<?php


namespace Roowix\ShopiconApp\Response;


class ResponseWriter
{
    public function write($data)
    {
        echo json_encode($data);
    }
}