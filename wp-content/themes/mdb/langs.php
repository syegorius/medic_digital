<?php

$langs=array(
"en"=>array(
    "en"			=> "en",
),
"he"=>array(
	"he"			=> "he",
)
);


function L($key,$langKey=false){//ICL_LANGUAGE_CODE=="en"
	global $langs;
	if(!$langKey)$langKey="en";
	if(isset($langs["en"][$key]))return $langs["en"][$key];
	else return "**"."en"."_".$key;
}

function heToEn($key){
	global $langs;
	if(preg_match("/^[a-z0-9\s\r\n]$/iu",$key))return $key;
	else{
		foreach($langs["he"] as $k=>$he)if(trim($he)==trim($key))return $langs['en'][$k];
		return $key;
	}
}