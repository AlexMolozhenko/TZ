<?php


namespace Services;


class ResponseService
{
   static public function jsonResponse($data, $status = 200) {
        header('Content-Type: application/json');

        http_response_code($status);

        echo json_encode($data);
        exit;
    }

}