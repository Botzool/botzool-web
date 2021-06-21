<?error_reporting(0);
$show=$_GET['show']; $lang=$_GET['lang']; $detail=$_GET['detail']; $res=$_GET['res']; $person=$_GET['person']; $topic=$_GET['topic'];
require 'io.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="description" content="Plant biosystematics; Laboratories, Research projects, People, Publications">
	<meta name="keywords" content="molecular methods,cytometry,karyology,evolution,genome size,base content,cyperaceae,poaceae,asteraceae,cyperaceae,geophytes,biodiversity">
	<link rel=stylesheet href="style.css" type="text/css" media="screen">
	<link rel="shortcut icon" href="images/systemgr.ico" type="image/x-icon">
	<title>
<?
if($lang=='cz')
{?>Biosystematika rostlin<?}
else
{?>Plant biosystematics<?}
?>
	</title>
</head>
<body>
	<div id="top_okraj"></div>
	<div id="head_pruh">
		<div id="head_pruh_inside">
			<img src="images/logo biosyst duotone.png" class="logo_biosyst_top">
			<img src="images/systematika_title_<?echo $lang;?>.png" id="biosyst_title">
			<img id="head_pruh_gradient" src="images/head_pruh_gradient.png">
			<img id="head_pruh_right" src="images/titles/04.jpg">
		</div>
	</div>

	<div id="menu">
		<ul>
<?
	if(!$show) $show = 'home';
	for($i=0; $i<$menu_size; $i++)
	{
		if($menu[$i][$lang])
		{
			echo '<li><a href="index.php?show='.$menu[$i][0].'&lang='.$lang.'"';
			if($show==$menu[$i][0]) echo ' class="active"';
			echo '>'.$menu[$i][$lang].'</a></li>'.$NL;
		}
	}
?>

			<a href="<?echo 'index.php?show='.$show.'&lang=en';?>"><img src="images/flag_en.png" class="menu_flag"></a>
			<a href="<?echo 'index.php?show='.$show.'&lang=cz';?>"><img src="images/flag_cz.png" class="menu_flag"></a>
		</ul>
	</div>

	<div id="content">
	<?
		if($show && $show!='home')
		{
			if($show=='gallery')
			{	require 'data/'.$show.'.htd';}
			elseif(File_Exists('data/'.$show.'_'.$lang.'.htd'))// require 'data/'.$show.'.htd';
				eval('?>'.format(FileRead('data/'.$show.'_'.$lang.'.htd')).'<?');
			elseif(File_Exists('data/'.$show.'.htd'))
				eval('?>'.format(FileRead('data/'.$show.'.htd')).'<?');
		}
		else require 'data/home_'.$lang.'.htd';
	?>

	</div>


<div id="bottom_pruh">
<div id="bottom_pruh_inside">
<div id="bottom_pruh_left">
<?
if($lang=='cz')
{?>
Skupina systematiky rostlin je součástí<br>
<a href="https://botzool.sci.muni.cz/">Ústavu botaniky a zoologie <img src="images/logo_ubz.png" class="smallicon"></a><br>
<a href="http://sci.muni.cz/">Přírodovědecké fakulty <img src="images/logo_sci.png" class="smallmuni"></a><br>
<a href="http://www.muni.cz/">Masarykovy univerzity <img src="images/logo_muni.png" class="smallmuni"></a><?
}
else
{?>
Plant biosystematics is a part of<br>
<a href="https://botzool.sci.muni.cz/en">Department of Botany and zoology <img src="images/logo_ubz.png" class="smallicon"></a><br>
<a href="http://sci.muni.cz/en">Faculty of Science <img src="images/logo_sci.png" class="smallmuni"></a><br>
<a href="http://www.muni.cz/en">Masaryk university <img src="images/logo_muni.png" class="smallmuni"></a><?
}
?>

</div>
<div id="bottom_pruh_center">
<?
if($lang=='cz')
{?>
Tvorba &amp; správa P. Veselý, 2020
<?
}
else
{?>
Created &amp; maintained by P. Veselý, 2020
<?
}
?>
</div>
<div id="bottom_pruh_right">
<?
if($lang=='cz')
{?>
<div class="bottom_adresa_bold">Poštovní adresa</div>
<div class="bottom_adresa">Kotlářská 267/2,<br>611 37, Brno, Česká republika</div>
<div class="bottom_adresa_bold">Adresa pracoviště</div>
<div class="bottom_adresa">Univerzitní kampus Bohunice, Kamenice 753/5 (budova A31),<br>625 00, Brno, Česká republika</div>
<?
}
else
{?>
<div class="bottom_adresa_bold">Postal address</div>
<div class="bottom_adresa">Kotlářská 267/2,<br>CZ-611 37, Brno, Czech Republic</div>
<div class="bottom_adresa_bold">Visiting address</div>
<div class="bottom_adresa">University campus Bohunice, Kamenice 753/5 (building A31),<br>CZ-625 00, Brno, Czech Republic</div>
<?
}
?>
</div>
</div>
</div>



<script>
var header = document.getElementById("menu");
var sticky = header.offsetTop;

window.onscroll = function()
{
  if (window.pageYOffset > sticky)
	{
    header.classList.add("menu_sticky");
  }
	else
	{
    header.classList.remove("menu_sticky");
  }
}

changeTitle = function()
{
	index = Math.floor(Math.random() * titles.length);
	head_pruh_right.src = 'images/titles/'.concat(titles[index]);
}

titles = ["<?echo join('", "', ls('images/titles/'));?>"];
setInterval(changeTitle, 10000);
changeTitle();
</script>

</body>
</html>