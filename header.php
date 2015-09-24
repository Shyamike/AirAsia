<?php session_start(); ?>
<!DOCTYPE html>
<html  lang="en" class="no-js">
<head>
    
    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Findmyfare Agent</title>
<link rel="shortcut icon" type="image/png" href="dist/images/favicon.png"/>

<!-- Bootstrap -->
<!--
<link href="dist/css/bootstrap_ie8.css" rel="stylesheet" type="text/css">
-->
<link href="dist/fonts/Hand_font/stylesheet.css" rel="stylesheet" type="text/css">
<link href="dist/css/tab.css" rel="stylesheet" type="text/css">
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="ie_style.css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="dist/css/notifmsg.css" />


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="dist/js/bootstrap.js"></script>

<!--[if IE 8]><!--><script type="text/javascript"> ///alert("aa");</script><!--<![endif]-->

<!-- jquery UI-->
<!--<script src="dist/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script src="dist/js/jquery-ui-timepicker-addon.js"></script>
  <link rel="stylesheet" href="dist/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">-->

<script>
function isIE () {
  var myNav = navigator.userAgent.toLowerCase();
  return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

$(function(){
if (isIE () == 8 ||isIE () == 9 ) {
 // IE8 code 
 
  $("head").append("<link>");
   var css = $("head").children(":last");
   css.attr({
     rel:  "stylesheet",
     type: "text/css",
     href: "dist/css/bootstrap_ie8.css"
  });
 
 
 
  $("head").append("<link>");
   var css = $("head").children(":last");
   css.attr({
     rel:  "stylesheet",
     type: "text/css",
     href: "dist/css/style_ie8.css"
  });
 
} else {
 // Other versions IE or not IE

  $("head").append("<link>");
   var css = $("head").children(":last");
   css.attr({
     rel:  "stylesheet",
     type: "text/css",
     href: "dist/css/bootstrap.css"
  });

}

});
</script>

<script>
(function ($) {
  var getUnqueuedOpts = function (opts) {
    return {
      queue: false,
      duration: opts.duration,
      easing: opts.easing
    };
  };
  $.fn.showDown = function (opts) {
    opts = opts || {};
    $(this).hide().slideDown(opts).animate({ opacity: 1 }, getUnqueuedOpts(opts));
  };
  $.fn.hideUp = function (opts) {
    opts = opts || {};
    $(this).show().slideUp(opts).animate({ opacity: 0 }, getUnqueuedOpts(opts));
  };
  $.fn.verticalFade = function (opts) {
    opts = opts || {};
    if ($(this).is(':visible')) {
      $(this).hideUp(opts);
    } else {
      $(this).showDown(opts);
    }
  };
}(jQuery));
</script>

<script src="dist/js/notifscript.js"></script>

