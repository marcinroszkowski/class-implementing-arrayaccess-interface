<?php

class ClassImplementingArrayAccessInterface implements ArrayAccess
{
	const INT_ARRAY_SIZE = 32;
	private $numberAsArray;

	public function __construct(int $number)
	{
		$this->numberAsArray = $this->convertNumberToArray($number);
	}
	
	public function offsetSet(int $offset, int $value) : void
	{
		$this->numberAsArray[$offset] = $value;
	}

	public function offsetGet(int $offset) : ?int
	{
		return ($this->numberAsArray[$offset]) ?? null;
	}
	
	public function offsetExists(int $offset) : bool
	{
		return (isset($this->numberAsArray[$offset])) ? true : false;
	}

	public function offsetUnset(int $offset) : void
	{
		if($this->offsetExists($offset))
			unset($this->numberAsArray[$offset]);
	}

	private function setBinaryNumber(int $number) : string
	{
		return decbin($number);
	}

	private function returnNumberAsArray(int $number) : array
	{
		$binaryNumber = $this->setBinaryNumber($number);
		return str_split($binaryNumber);
	}

	private function convertNumberToArray(int $number) : array
	{
		$array = $this->returnNumberAsArray($number);
		$arraySize = count($array);
		
		for($i = 0; $i < self::INT_ARRAY_SIZE-$arraySize; $i++)
			array_unshift($array, 0);

		return $array;
	}
}
?>
