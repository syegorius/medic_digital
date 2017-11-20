<?php

$langs=array(
"en"=>array(
        'archive'=>'Archives',
        'archive_link'=>'archive-guidelines-and-position-papers',
	'article'=>'Articles',
	'archive_quidelines'=>'Archive guidelines and position papers',
	'archive_guidelines_and_papers'=>'Archive papers and guidelines and procedures',
	'company'=>'Companies',
        'companies'=>'Companies',
        'companies_link'=>'companies',
	'copy_sign'=>'2017 &copy; Pharma Israel',
	'details'=>'details',
	'event'=>'Events',
        'event_link'=>'conferences-and-events',
	'homepage'=>'Homepage',
	'listen'=>'listen',
	'month01'=>'January',
	'month02'=>'February',
	'month03'=>'March',
	'month04'=>'April',
	'month05'=>'May',
	'month06'=>'June',
	'month07'=>'July',
	'month08'=>'August',
	'month09'=>'September',
	'month10'=>'October',
	'month11'=>'November',
	'month12'=>'December',
	'overview'=>'Overview',
	'papers'=>'Papers',
        'papers_link'=>'guidelines-and-procedures',
	'publications'=>'Publications on this topic and more',
	'regulations'=>'Regulations',
	'website'=>'Website',
	'video'=>'Videos',
        'view'=>'play',
        'workers'=>'Pharmaceutical workers',
),
"he"=>array(
        'archive'=>'ארכיון',
        'archive_link'=>'ארכיון-הנחיות-וניירות-עמדה',
	'article'=>'מחקרים',
	'archive_quidelines'=>'לארכיון הנחיות וניירות והנהלים',
	'archive_guidelines_and_papers'=>'לארכיון הנחיות וניירות והנהלים',
	'company'=>'חברות בארגון',
	'companies'=>'Companies',
        'companies_link'=>'חברות-בארגון',
	'copy_sign'=>'פארמה ישראל © 2017',
	'details'=>'לפרטים נוספים',
	'event'=>'אירועים',
        'event_link'=>'כנסים-וארועים',
	'homepage'=>'דף הבית',
	'listen'=>'להאזנה',
	'month01'=>'ינואר',
	'month02'=>'פברואר',
	'month03'=>'מרץ',
	'month04'=>'אפריל',
	'month05'=>'מאי',
	'month06'=>'יוני',
	'month07'=>'יולי',
	'month08'=>'אוגוסט',
	'month09'=>'ספטמבר',
	'month10'=>'אוקטובר',
	'month11'=>'נובמבר',
	'month12'=>'דצמבר',
	'overview'=>'סקירה כללית',
	'papers'=>'נייר עמדה',
        'papers_link'=>'הנחיות-ונהלים',
	'publications'=>'לפרסומים בנושא זה ועוד',
	'website'=>'לאתר',
	'regulations'=>'רגולציה',
        'video'=>'Videos',
	'view'=>'לצפייה',
	'workers'=>'עובדי הפארמה',
)
);


function L($key){
	global $langs;
	if(isset($langs[ICL_LANGUAGE_CODE][$key]))return $langs[ICL_LANGUAGE_CODE][$key];
	else return "**".ICL_LANGUAGE_CODE."_".$key;
}

function heToEn($key){
	global $langs;
	if(preg_match("/^[a-z0-9\s\r\n]$/iu",$key))return $key;
	else{
		foreach($langs["he"] as $k=>$he)if(trim($he)==trim($key))return $langs['en'][$k];
		return $key;
	}
}