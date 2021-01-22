<?php
require_once("include/header.php");

$time = date("H");
$timezone = date("e");
if ($time < "12") {
    echo "<h5> Good morning $instructorLoggedName </h5>";
} else
if ($time >= "12" && $time < "17") {
    echo "<h5> Good afternoon $instructorLoggedName </h5>";
} else
if ($time >= "17" && $time < "19") {
    echo "<h5> Good evening  $instructorLoggedName </h5>";
} 
else
if ($time >= "19") {
    echo "<h5> Good night $instructorLoggedName </h5>";
}

?>


<?php
require_once("include/header.php");

 
//  echo "
//  <h5>". date("h:i:s")."<br>".date("Y-m-d")." ".date("l"). "</h5>";
$date = date("Y-m-d");
echo "<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =
  h + ':' + m + ':' + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = '0' + i};  // add zero in front of numbers < 10
  return i;
}
</script>


<body onload='startTime()'>

<p id='txt'></p>";

?>


