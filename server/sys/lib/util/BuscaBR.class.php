<?php
namespace root\server\sys\lib\util;
/**
 * BuscaBR - Biblioteca PHP para algoritmo de busca fonética BuscaBR.
 * @version 0.1.0
 * @package BuscaBR
 * @link https://github.com/ClubeDosGeeksCoding/buscabr-php GitHub project
 * @author Jayr Alencar (jayralencar) <jayralencarpereira@gmail.com>
 * @copyright 2016 - Clube dos Geeks (http://clubedosgeeks.com.br)
 * @license The MIT License (MIT) (https://github.com/ClubeDosGeeksCoding/buscabr-php/blob/master/LICENSE)
 **/



/**
 * BuscaBR - Biblioteca PHP para algoritmo de busca fonética BuscaBR.
 * @package BuscaBR
 * @author Jayr Alencar (jayralencar) <jayralencarpereira@gmail.com>
 */
class BuscaBR
{



	/* BUSCABR*/

	/*
	http://www.unibratec.com.br/jornadacientifica/diretorio/NOVOB.pdf
	Baseado no Algoritimo de FRED JORGE TAVARES DE LUCENA
	E-mail: Fred.lucena@unibratec.com.br
	echo BuscaBR::Fonetica("José da Silva", 1); //O 1 aqui faz com que o retorno venha delimitado por //...
	echo BuscaBR::Fonetica("José da Silva");
	*/
	//echo SoundexBR("valter");

		static public function Fonetica($nome,$delimitador = FALSE)
		{
			if (strpos($nome," ") !== FALSE)
			{
				$nome1 = explode(" ",$nome);
				foreach($nome1 as &$val)
					$val = self::SoundexBR($val);

				$nome1 = implode(" ",$nome1);
			}
			else
				$nome1 = self::SoundexBR($nome);

			$nome1 = trim($nome1);
			if ($delimitador)
				$nome1 = "/ $nome1 /";
			else
				$nome1 = " $nome1 ";
			return $nome1;
		}

		public function SoundexBR ($string)
		{
			$string=trim($string);
			//1. Para Minuscula - Faster Insensitive
			$string = utf8_decode($string);
			$string = strtolower($string);
			$string = utf8_encode($string);
			//2. Remove Acentos
			$arr = array(
			"á"=>"a",
			"â"=>"a",
			"à"=>"a",
			"ã"=>"a",
			"ä"=>"a",
			"é"=>"e",
			"ê"=>"e",
			"è"=>"e",
			"ë"=>"e",
			"í"=>"i",
			"î"=>"i",
			"ì"=>"i",
			"ï"=>"i",
			"ó"=>"o",
			"õ"=>"o",
			"ò"=>"o",
			"ô"=>"o",
			"ö"=>"o",
			"ú"=>"u",
			"ù"=>"u",
			"û"=>"u",
			"ü"=>"u"
			);
			$string = strtr($string,$arr);
			$arr = array(
			"bl"=>"b", //4
			"br"=>"b", //4
			"ca"=>"k", //8
			"ce"=>"s",
			"ci"=>"s",
			"co"=>"k", //8
			"cu"=>"k", //8
			"ck"=>"k", //8
			"ç"=>"s", //13
			"ch"=>"s", //13
			"ct"=>"t",
			"ge"=>"j",
			"gi"=>"j",
			"gm"=>"m",
			"gl"=>"g",
			"gr"=>"g",
			"l"=>"r",
			"n"=>"m",
			"md"=>"m",
			"mg"=>"g",
			"mj"=>"j",
			"ph"=>"f",
			"fh"=>"f",
			"pr"=>"p",
			"q"=>"k",
			"rg"=>"g",
			"rs"=>"s",
			"rt"=>"t",
			"rm"=>"sm",
			"rj"=>"j",
			"st"=>"t",
			"tr"=>"t",
			"tl"=>"t",
			"ts"=>"s",
			"w"=>"v",
			"x"=>"s",
			"st"=>"t",
			"y"=>"i",
			"z"=>"s",
			);
			$string = strtr($string,$arr);
			if (substr($string,-2) == "ao")	$string = substr($string,0,-2)."m"; //10
			//Termincao S z R M N AO L
			if (substr($string,-1) == "s")	$string = substr($string,0,-1); //16
			if (substr($string,-1) == "z")	$string = substr($string,0,-1); //16
			if (substr($string,-1) == "r")	$string = substr($string,0,-1); //16
			if (substr($string,-1) == "r")	$string = substr($string,0,-1); //16
			if (substr($string,-1) == "m")	$string = substr($string,0,-1); //16
			if (substr($string,-1) == "n")	$string = substr($string,0,-1); //16
			if (substr($string,-2) == "ao")	$string = substr($string,0,-2); //16
			if (substr($string,-1) == "l")	$string = substr($string,0,-1); //16
			$arr = array(
			"r"=>"l", //17
			"h"=>"", //18
			"a"=>"", //18
			"e"=>"", //18
			"i"=>"", //18
			"o"=>"", //18
			"u"=>"", //18
			"aa"=>"a",//19
			"bb"=>"b",
			"cc"=>"c",
			"dd"=>"d",
			"ee"=>"e",
			"ff"=>"f",
			"gg"=>"g",
			"hh"=>"h",
			"ii"=>"i",
			"jj"=>"j",
			"kk"=>"k",
			"ll"=>"l",
			"mm"=>"m",
			"nn"=>"n",
			"oo"=>"o",
			"pp"=>"p",
			"qq"=>"q",
			"rr"=>"r",
			"ss"=>"s",
			"tt"=>"t",
			"uu"=>"y",
			"vv"=>"v",
			"ww"=>"w",
			"xx"=>"x",
			"yy"=>"y",
			"zz"=>"z" //19
			);
			$string = strtr($string,$arr);
			return $string;
		}

	 /*
     * encode texto para buscaBR.
     * @param string $str
     * @return string
     * @author Jayr Alencar (jayralencar) <jayralencarpereira@gmail.com>

	public static function encode($str){
		$str = self::removeAcents($str);
		$str = strtoupper($str);
		$codes = array(
			array('/(BR|BR)/', 'B'),
			array('/PH/', 'F'),
			array('/(GL|GR|MG|NG|RG)/', 'G'),
			array('/Y/', 'I'),
			array('/(GE|GI|RJ|MJ)/', 'J'),
			array('/N/', 'M'),
			array('/(AO|AUM|GM|MD|OM|ON)/', 'M'),
			array('/PR/', 'P'),
			array('/L/', 'R'),
			array('/(CE|CI|CH|CS|RS|TS|X|Z)/', 'S'),
			array('/(TR|TL)/', 'T'),
			array('/(CT|RT|ST|PT)/', 'T'),
			array('/\b[UW]/', 'V'),
			array('/RM/', 'SM'),
			array('/[MRS]+\b/', ''),
			array('/[AEIOUH]/', ''),
                    array('/SAO/', 'SM')
		) ;

		for($i = 0 ; $i < sizeof($codes); $i++){
			$str = preg_replace($codes[$i][0], $codes[$i][1], $str);
		}

		$str = self::squeeze($str);

		return $str;
	}


     * Remove acentos de string.
     * @param string $string
     * @return string
     * @author Jayr Alencar (jayralencar) <jayralencarpereira@gmail.com>


	private  function removeAcents($string){
	    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
	}


     * Remove caracteres duplicados seguidos.
     * @param string $str
     * @return string
     * @author Jayr Alencar (jayralencar) <jayralencarpereira@gmail.com>

	private function squeeze($str){
		$cont = 0;
		$strArray = str_split($str);
		$newString='';
		for($i =  0 ; $i < sizeof($strArray); $i++){
			$final = isset($strArray[$i+1])?$strArray[$i+1]:'';
			if($strArray[$i] != $final){
				$newString .=$strArray[$i];
			}
		}
		return $newString;
	}
*/
}
