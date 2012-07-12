<?php

class	AddConfToFile
{
	public $fd;
	public $path;
	public $mode;
	public $error = false;
	
	public function __construct($fpath, $fmode)
	{
		$this->path = trim($fpath);
		$this->mode = trim($fmode);
		$this->checkFile();
		if (($this->mode == 'w') AND ($this->error == false)){
			if (($res = @fwrite($this->fd, '<?php'."\n")) == false){
				$this->error = "Erreur d'écriture";
			}
		} else{
			echo $this->error;
		}
	}
	
	public function __destruct()
	{
		if (!$this->error)
			@fclose($this->fd);
	}
	
	private function checkFile(){

		if(file_exists($this->path) == false){
			$this->error = "File don't exist";
		} elseif (is_writable($this->path) == false) {
			$this->error = "File is NOT writable";
		} elseif (is_readable($this->path) == false) {
			$this->error = "File is NOT readable";
		}

		$file = fopen($this->path, $this->mode);	
		if ($file == false){
			$this->error = "Open error";

		} else {
			$this->fd = $file;
		}
	}
	
	public function writeDefine($name, $data)
	{
		if (!$res = @fwrite($this->fd,
			'define(\''.$name.'\', \''.$this->checkString($data).'\');'."\n"))
		{
			$this->error = "Erreur d'écriture";
			return false;
		}
		return true;
	}
	
	public function writeEndTagPhp()
	{
		if (!$res = @fwrite($this->fd, '?>'."\n")) {
			$this->error = "Erreur d'écriture";
			return false;
		}
		return true;
	}
	
	public function checkString($string)
	{
		if (get_magic_quotes_gpc())
			$string = stripslashes($string);
		if (!is_numeric($string))
		{
			$string = addslashes($string);
			$string = strip_tags(nl2br($string));
		}
		return $string;
	}
}

?>