<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 23.03.2015
 * Time: 0:28
 1. Sozdaem socket
 2. Ustanavlivaem soedinenie s clientami
 3. Server prinimaet vse soedinenia
 */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, '192.168.0.1', 9000);
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1); //razreshaem ispolzovat odin port dlia neskolkix soedinenii
socket_listen($socket);

while($connect = stream_socket_accept($socket, -1)){
    $response = implode("\r\n", [
        'HTTP/1.1 200 OK',
        'Content-Length: 3',
        '',
        "Hi\n",
    ]);
    fwrite($connect, $response);
    fclose($connect);
}