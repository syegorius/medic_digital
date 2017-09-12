<?php

$langs=array(
"en"=>array(
    "footer_text"			=> "Manufactory: ELI LILLY & COMPANY LTD., USA  |  LILLY TECHNOLOGY CENTER, INDIANOPOLIS, INDIANA 46285, USA  |  License Holder: ELI LILLY ISRAEL LTD, 4 HASHEIZAF ST, XURA, RA’ANANA 4366411
                            <br />
                            For full prescribing Information please see the approved MOH PPI  |  CYR03201700043",
),
"he"=>array(
	"footer_text"			=> "Manufactory: ELI LILLY & COMPANY LTD., USA  |  LILLY TECHNOLOGY CENTER, INDIANOPOLIS, INDIANA 46285, USA  |  License Holder: ELI LILLY ISRAEL LTD, 4 HASHEIZAF ST, XURA, RA’ANANA 4366411
                            <br />
                            For full prescribing Information please see the approved MOH PPI  |  CYR03201700043",
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