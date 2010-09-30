<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- Copyright 2010 Neocenter S.A. de C.V.                             -->
<!-- Distributed under the terms of the GNU Affero GPL v3              -->
<!-- $Header: $                                                        -->
<!--                                                                   -->
<!-- Yet another Punch Clock solution for Asterisk and Elastix         -->
<!--        to work with 2N Helios door communicator                   -->
<!--                                                                   -->
<!-- Author:                                                           -->
<!--       Octavio Ruiz (Ta^3)   tacvbo@tacvbo.net                     -->
<!--                                                                   -->
<!-- http://github.com/tacvbo/yapclock                                 -->
<!--                                                                   -->
<!-- This program is distributed in the hope that it will be useful,   -->
<!-- but WITHOUT ANY WARRANTY. YOU USE AT YOUR OWN RISK. THE AUTHOR    -->
<!-- WILL NOT BE LIABLE FOR DATA LOSS, DAMAGES, LOSS OF PROFITS OR ANY -->
<!-- OTHER  KIND OF LOSS WHILE USING OR MISUSING THIS SOFTWARE.        -->
<!-- See the GNU Affero General Public License for more details.       -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>2N Helios Camera</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" charset="utf-8">
    <script src="./js/jquery-1.4.2.js" type="text/javascript" charset="utf-8"></script>
    <script language="javascript" type="text/javascript">
    var camera_url = "http://10.20.30.71/enu/camera640x480.jpg";
    function load() {
      setInterval("camera_update()",1000);
    }

    function camera_update(){
      var now = new Date();
      var hour = now.getHours() + ':' +
        now.getMinutes() + ':' +
        now.getSeconds() + ' ';
      var date = now.getDate() + '/' +
           ( now.getMonth()+1) + '/' +
           now.getFullYear();
      $('<h3 id="hour">' + hour + '</h3>').replaceAll('#hour');
      $('<h3 id="date">' + date + '</h3>').replaceAll('#date');
      $('#camera').attr("src",camera_url + "?date=" + now.getTime());       
    }
    </script>
  </head>

  <body onload="load();">
    <div align="center">
      <div id="date">&nbsp;</div>
      <img id="camera" \>
      <div id="hour">&nbsp;</div>
    </div>
  </body>

</html>
