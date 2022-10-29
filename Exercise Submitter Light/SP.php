<?php
	function GetYear($inp)
	{
		$inp=str_replace("_","-",$inp);
		$c=explode("-",$inp);
		return $c[2];
	}
	function GetMonth($inp)
	{
		$inp=str_replace("_","-",$inp);
		$c=explode("-",$inp);
		return $c[3];
	}
	
	function GetDay($inp)
	{
		$inp=str_replace("_","-",$inp);
		$c=explode("-",$inp);
		return $c[4];
	}
	
	function GetYear2($inp)
	{
		$inp=str_replace("_","-",$inp);
		$c=explode("-",$inp);
		return $c[0];
	}
	function GetMonth2($inp)
	{
		$inp=str_replace("_","-",$inp);
		$c=explode("-",$inp);
		return $c[1];
	}
	
	function GetDay2($inp)
	{
		$inp=str_replace("_","-",$inp);
		$c=explode("-",$inp);
		return $c[2];
	}
?>