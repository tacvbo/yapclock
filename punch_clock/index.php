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
<?php
$req = $_REQUEST['date'];
if ( $req !== null) {
  $today = $req;
} else {
  $today = date("Y-m-d");
}
echo '<title>Helios 2N\'s Punch Clock - ' . $today . '</title>';
?>
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" charset="utf-8">
    <script src="./js/jquery-1.4.2.js" type="text/javascript" charset="utf-8"></script>
    <script src="./js/application.js" type="text/javascript" charset="utf-8"></script>
  </head>
  <body id="index">
    <div id="pagewrap">
      <div id="search">
        <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
<?php
$tomorrow = date("Y-m-d", mktime(0, 0, 0, date("m", strtotime("$today")), date("d", strtotime("$today"))+1, date("Y", strtotime("$today"))));
$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m", strtotime("$today")), date("d", strtotime("$today"))-1, date("Y", strtotime("$today"))));
echo '<form action="index.php" method="post">';
echo '<input type="text" name="date" value="' . $yesterday . '" />';
echo '<input type="submit" value="Yesterday"/>';
echo '</form> ';
echo '<form action="index.php" method="post">';
echo '<input type="text" name="date" value="' . $tomorrow . '" />';
echo '<input type="submit" value="Tomorrow"/>';
echo '</form> ';
echo '<img src=thumb_bg.png /> ';
?>
      </div>
      <div id="body">
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Date</th>
              <th>Photo</th>
              <th>Name</th>
              <th>Extension</th>
              <th>Hour</th>
            </tr>
          </thead>
          <tbody>
<?php
include('data/' . $today . '_data.html');
?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
