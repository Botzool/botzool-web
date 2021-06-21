<?
//Funkce pro praci se soubory a adresari
function ls($dir, $type='all', $hidden=0)
{	$dp = OpenDir($dir);
	$seznam = Array();
	$nazev = ReadDir($dp);
	while($nazev)
	{	if($nazev!='.' && $nazev!='..' && (!$hidden && $nazev[0]!='.'))
		{	if(($type=='dirs' && is_dir($dir.$nazev)) || ($type=='files' && is_file($dir.$nazev)) || $type=='all')
			{	$seznam[] = $nazev;}
		}
		$nazev = ReadDir($dp);
	}
	CloseDir($dp);
	return $seznam;
}

function FileRead($file, $hide=0)
{
 if(File_Exists($file))
 {
	$fp = FOpen($file, 'r');
	if (!$fp) echo 'Nepodařilo se otevřít soubor '.$file.'!<br>';
	$data = FRead($fp, FileSize($file));
	FClose($fp);
  return $data;
 }
 elseif(!$hide) {echo 'Soubor '.$file.' neexistuje!<br>'; return false;}
}

function FileWrite($file, $string)
{
 $fp = FOpen($file, 'w');
 if(!fp) echo 'Nepodařilo se vytvořit soubor '.$file.'!';
 elseif(!FPutS($fp, $string))	echo 'Zápis do souboru '.$file.' selhal!<br>';
 else	{FClose($fp); $return = 1;}
 return $return;
}

function arraySize($array)
{	$size=sizeOf($array);
	if($size>1 || $array[0]) return $size;
	else return 0;
}

function array_isearch($str, $array)
{	$str = toLowerCase($str);
	foreach ($array as $k => $v) if(toLowerCase($v) == $str) return $k;
	return false;
} 

function array_alias($str, $array)
{	$str = toLowerCase($str);
	foreach ($array as $k => $v) if(toLowerCase($array[$k][0]) == $str) return $k;
	return false;
} 

function array_indexOf($str, $array)
{	$str = toLowerCase($str);
	foreach ($array as $k => $v) if(strpos(toLowerCase($v), $str)) return $k;
	return false;

}

function array_sort($pole, $funkce=NULL)
{	//poradi pismen, prevedeme to na poradi ASCII znaku
	$poradi = 'aäáàâăāãåąấầắằǻẫẵảẩẳạậặæǽbcċćĉçčdďđeėëéèêěĕēẽęếềễẻểẹệfƒgġĝğģhĥħiıïíìîĭīĩįỉịjĵkķlŀĺľļłmnńňñņoöóòôŏōõőốồøỗǿỏơổọớờỡộởợpqrŕŗřsśŝşštťţŧuüúùûŭūũůųűủưụứừữửựvwẃẁŵẅxyÿýỳŷỹỷỵzżźž'.
			'аӑӓбвгґҕѓғдђеҽёҿәӛӕѐӗєӟӭжҗӂӝзҙӡѕиіӀїѝӥӣҋйјкҟӄӆҝҡќқлљмӎнңҥһӈњоҩөӧӫпҧрҏсҫтҭћуүўұӳӱӯфхӊҳцҵчҷҹӌӵџшщъыӹьҍэюя';
	$prevod = Array();
	for($i=0,$size=length($poradi); $i<$size; $i++)
	{	$prevod[charAt($poradi, $i)] = utf_chr($i);
	}
	$sortby = Array();
	foreach($pole as $index => $value)
	{	if($funkce) {eval('$value = '.$funkce.'($value);');}
		for($i=0,$delka=length($value); $i<$delka; $i++)
		{	$sortby[$index] .= $prevod[toLowerCase(charAt($value, $i))];}
	}
	array_multisort($sortby, SORT_ASC, SORT_STRING, $pole, SORT_ASC, SORT_STRING);
	return $pole;
}

function loadvar($file)
{ Global $NL;
	$toSet = explode($NL, FileRead($file, 1));
	for($i=0, $size=SizeOf($toSet); $i<$size; $i++)
	{    $toSet[$i] = explode("\t", $toSet[$i]);}
	return $toSet;
}

//Retezcove funkce
function hodnota($arr, $vyraz)
{	$vyraz = toLowerCase($vyraz);
	for($i=0, $size=SizeOf($arr); $i<$size; $i++)
	{	if(toLowerCase($arr[$i][0])==$vyraz) return format($arr[$i][1]);}
}

function format($str)
{ return str_replace('--', '–', str_replace('---', '—', $str));}

function nohtml($str)
{ return str_replace('<i>', '', str_replace('</i>', '', str_replace('<b>', '', str_replace('</b>', '', str_replace('<em>', '', str_replace('</em>', '', str_replace('<u>', '', str_replace('</u>', '', $str))))))));}

//Retezcove funkce
function bezdia($string)
{
	return utf_strtr($string, 'ÁáÀàĂăẮắẰằẴẵẲẳÂâẤấẦầẪẫẨẩÅåǺǻÄäÃãĄąĀāẢảẠạẶặẬậǼǽĆćĈĉČčĊċÇçĎďĐđÉéÈèĔĕÊêẾếỀềỄễỂểĚěËëẼẽĖėĘęĒēẺẻẸẹỆệƒĞğĜĝĠġĢģĤĥHĦħÍíÌìĬĭÎîÏïĨĩİiĮįĪīỈỉỊịIıĴĵĶķĹĺĽľĻļŁłĿŀŃńŇňÑñŅņÓóÒòŎŏÔôỐốỒồỖỗỔổÖöŐőÕõØøǾǿŌōỎỏƠơỚớỜờỠỡỞởỢợỌọỘộPpŔŕŘřŖŗŚśŜŝŠšŞşŤťŢţŦŧÚúÙùŬŭÛûŮůÜüŰűŨũŲųŪūỦủƯưỨứỪừỮữỬửỰựỤụẂẃẀẁŴŵẄẅÝýỲỳŶŷŸÿỸỹỶỷỴỵŹźŽžŻż', 'AaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaAaCcCcCcCcCcDdDdEeEeEeEeEeEeEeEeEeEeEeEeEeEeEeEeEefGgGgGgGgHhHHhIiIiIiIiIiIiIiIiIiIiIiIiJjKkLlLlLlLlLlNnNnNnNnOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoOoPpRrRrRrSsSsSsSsTtTtTtUuUuUuUuUuUuUuUuUuUuUuUuUuUuUuUuUuUuWwWwWwWwYyYyYyYyYyYyYyZzZzZz');
}

//velikost obrazku
function imgsize($src, $podil)
{	Global $res;
	echo '<img src="'.$src.'" width="'.($res/$podil).'">';
}

//Priprava promennych
$NL="\r\n";
require 'utf8.php';
if(!$lang) $lang='cz';

$menu = file_get_contents('data/menu.txt');
$menu = explode($NL, $menu);
for($i=0,$menu_size=sizeof($menu);$i<$menu_size;$i++)
{
	$menu[$i] = explode("\t", $menu[$i]);
	$menu[$i]['cz'] = $menu[$i][1];
	$menu[$i]['en'] = $menu[$i][2];
}

$foto_cesta = 'fotky/';
$foto_thumb_big=240; $foto_thumb_small=120;

?>