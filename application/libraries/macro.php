<?php
HTML::macro('image_link', function($url = '', $img='img/', $alt='', $paramLink = false, $paramImg = false, $active=true, $ssl=false)
{
	$url = $ssl==true ? URL::to_secure($url) : URL::to($url);  
	$img = HTML::image($img,$alt,$paramImg);
	$link = $active==true ? HTML::link($url, '#', $paramLink) : $img;
	$link = str_replace('#',$img,$link);
	return $link;
}); 