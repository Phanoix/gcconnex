<?php 

/**
 * Languages according to ISO 639-1
 */

	$options = array(
	
		"aa" => "Afar",
		"ab" => "Abkhazian",
		"af" => "Afrikaans",
		"am" => "Amharic",
		"ar" => "Arabic",
		"as" => "Assamese",
		"ay" => "Aymara",
		"az" => "Azerbaijani",
		"ba" => "Bashkir",
		"be" => "Byelorussian",
		"bg" => "Bulgarian",
		"bh" => "Bihari",
		"bi" => "Bislama",
		"bn" => "Bengali; Bangla",
		"bo" => "Tibetan",
		"br" => "Breton",
		"ca" => "Catalan",
		"co" => "Corsican",
		"cs" => "Czech",
		"cy" => "Welsh",
		"da" => "Danish",
		"de" => "German",
		"dz" => "Bhutani",
		"el" => "Greek",
		"en" => "English",
		"eo" => "Esperanto",
		"es" => "Spanish",
		"et" => "Estonian",
		"eu" => "Basque",
		"fa" => "Persian",
		"fi" => "Finnish",
		"fj" => "Fiji",
		"fo" => "Faeroese",
		"fr" => "French",
		"fy" => "Frisian",
		"ga" => "Irish",
		"gd" => "Scots / Gaelic",
		"gl" => "Galician",
		"gn" => "Guarani",
		"gu" => "Gujarati",
		"he" => "Hebrew",
		"ha" => "Hausa",
		"hi" => "Hindi",
		"hr" => "Croatian",
		"hu" => "Hungarian",
		"hy" => "Armenian",
		"ia" => "Interlingua",
		"id" => "Indonesian",
		"ie" => "Interlingue",
		"ik" => "Inupiak",
		"is" => "Icelandic",
		"it" => "Italian",
		"iu" => "Inuktitut",
		"iw" => "Hebrew (obsolete)",
		"ja" => "Japanese",
		"ji" => "Yiddish (obsolete)",
		"jw" => "Javanese",
		"ka" => "Georgian",
		"kk" => "Kazakh",
		"kl" => "Greenlandic",
		"km" => "Cambodian",
		"kn" => "Kannada",
		"ko" => "Korean",
		"ks" => "Kashmiri",
		"ku" => "Kurdish",
		"ky" => "Kirghiz",
		"la" => "Latin",
		"ln" => "Lingala",
		"lo" => "Laothian",
		"lt" => "Lithuanian",
		"lv" => "Latvian/Lettish",
		"mg" => "Malagasy",
		"mi" => "Maori",
		"mk" => "Macedonian",
		"ml" => "Malayalam",
		"mn" => "Mongolian",
		"mo" => "Moldavian",
		"mr" => "Marathi",
		"ms" => "Malay",
		"mt" => "Maltese",
		"my" => "Burmese",
		"na" => "Nauru",
		"ne" => "Nepali",
		"nl" => "Dutch",
		"no" => "Norwegian",
		"oc" => "Occitan",
		"om" => "(Afan) Oromo",
		"or" => "Oriya",
		"pa" => "Punjabi",
		"pl" => "Polish",
		"ps" => "Pashto / Pushto",
		"pt" => "Portuguese",
		"qu" => "Quechua",
		"rm" => "Rhaeto-Romance",
		"rn" => "Kirundi",
		"ro" => "Romanian",
		"ru" => "Russian",
		"rw" => "Kinyarwanda",
		"sa" => "Sanskrit",
		"sd" => "Sindhi",
		"sg" => "Sangro",
		"sh" => "Serbo-Croatian",
		"si" => "Singhalese",
		"sk" => "Slovak",
		"sl" => "Slovenian",
		"sm" => "Samoan",
		"sn" => "Shona",
		"so" => "Somali",
		"sq" => "Albanian",
		"sr" => "Serbian",
		"ss" => "Siswati",
		"st" => "Sesotho",
		"su" => "Sundanese",
		"sv" => "Swedish",
		"sw" => "Swahili",
		"ta" => "Tamil",
		"te" => "Tegulu",
		"tg" => "Tajik",
		"th" => "Thai",
		"ti" => "Tigrinya",
		"tk" => "Turkmen",
		"tl" => "Tagalog",
		"tn" => "Setswana",
		"to" => "Tonga",
		"tr" => "Turkish",
		"ts" => "Tsonga",
		"tt" => "Tatar",
		"tw" => "Twi",
		"ug" => "Uigur",
		"uk" => "Ukrainian",
		"ur" => "Urdu",
		"uz" => "Uzbek",
		"vi" => "Vietnamese",
		"vo" => "Volapuk",
		"wo" => "Wolof",
		"xh" => "Xhosa",
		"yi" => "Yiddish",
		"yo" => "Yoruba",
		"za" => "Zuang",
		"zh" => "Chinese",
		"zu" => "Zulu"
	);
	
	foreach(get_installed_translations() as $index => $lang){
		unset($options[$index]);
	}
	
	asort($options);
	
	$form_body .= elgg_view("input/dropdown", array("options_values" => $options, "name" => "code"));
	$form_body .= " ";
	$form_body .= elgg_view("input/submit", array("value" => elgg_echo("save")));
	
	$form = elgg_view("input/form", array("body" => $form_body, "action" => $vars["url"] . "action/translation_editor/add_language", "id" => "translation_editor_add_language_form", "class" => "hidden"));

	echo "<div>";
	echo "<a href='javascript:void(0);' onclick='$(\"#translation_editor_add_language_form\").toggle();'><b>+</b> " . elgg_echo("translation_editor:language_selector:add_language") . "</a>";
	echo $form;
	echo "</div>";
