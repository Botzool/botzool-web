<?
function length($str)
{ return mb_strlen($str, 'UTF-8');}

function toLowerCase($str)
{ return mb_strtolower($str, 'UTF-8');}

function toUpperCase($str)
{ return mb_strtoupper($str, 'UTF-8');}

function charAt($str, $i)
{ return mb_substr($str, $i, 1, 'UTF-8');}

function utf8substr($str, $i, $length)
{ if(!$length) $length = length($str);
  return mb_substr($str, $i, $length-$i, 'UTF-8');
}

function utf_chr($i)
{ return mb_convert_encoding('&#' . intval($i) . ';', 'UTF-8', 'HTML-ENTITIES');
}

function utf_strtr($str, $orig, $to)
{ for($i=0, $length=length($orig); $i<$length; $i++)
  { $str = str_replace(charAt($orig, $i), charAt($to, $i), $str);}
  return $str;
}

function mime_utf8_header($string)
{
  return '=?UTF-8?B?'.base64_encode($string).'?=';
}
?>