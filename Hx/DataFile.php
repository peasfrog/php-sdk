<?php
class DataFile
{
    public $file_name;
    public $data;
    public $size;
    private $handle;

    public function __const()
    {
        $file = new DataFile();
        return $file;
    }

    public function __destruct(){}


    public function file_exists(){
        return file_exists($this->file_name);
    }

    public function setName($name){
        $this->file_name = $name;
    }

    public function open() {
        $this->handle = fopen($this->file_name, 'wb');
    }

    public function read(){
        $this->handle = fopen($this->file_name, 'r');
        return fread($this->handle, filesize($this->file_name));
    }

    public function write($data){
        $this->setData($data);
        fwrite($this->handle, $data);
    }

    public function close()
    {
        fclose($this->handle);
        $this->handle = null;
    }
    public function setData($data){
        $this->data = $data;
        $this->size = sizeOf($this->data);
    }
}
?>