<!doctype html>
<? include 'head.php' ?>


<body>
<?php include 'navbar.php'; ?>

<div style="margin: 60px 0 0 10px;">

<input class="btn primary" id="csv-generator" type="submit" value="Export CSV" />

<?php

 mysql_connect("localhost", "sourcebuilder", "BjHLdTGjQsxmyRKM") or die(mysql_error()); 
 mysql_select_db("sourcebuilder") or die(mysql_error()); 
 
$query="SELECT * FROM `sourcelog`";
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();
?>
<table id="log-table" class="condensed-table zebra-striped" style="width: 95%;">
<colgroup style="width: 50px;"></colgroup>
<colgroup style="width: 125px;"></colgroup>
<colgroup span="5" style="width: 50px;"></colgroup>
<colgroup style="width: 75px;"></colgroup>
<colgroup style="width: 125px;"></colgroup>
<colgroup style="width: 125px;"></colgroup>
<colgroup style="width: 50px;"></colgroup>
<thead>
<tr>
<th>Client</th>
<th>Base URL</th>
<th>Platform</th>
<th>Medium</th>
<th>Date</th>
<th>Campaign</th>
<th>Additional</th>
<th>Full Source</th>
<th>Full URL</th>
<th>Comments</th>
<th>Entered</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
while ($i < $num) {

$f1=mysql_result($result,$i,"Client");
$f2=mysql_result($result,$i,"Base");
$f3=mysql_result($result,$i,"Platform");
$f4=mysql_result($result,$i,"Medium");
$f5=mysql_result($result,$i,"Date");
$f6=mysql_result($result,$i,"Campaign");
$f7=mysql_result($result,$i,"Additional");
$f8=mysql_result($result,$i,"FullSource");
$f9=mysql_result($result,$i,"FullURL");
$f10=mysql_result($result,$i,"Comments");
$f11=mysql_result($result,$i,"Timestamp");
?>

<tr>
<td><?php echo $f1; ?></td>
<td><a href="<?php echo $f2; ?>" target="_blank"><?php echo $f2; ?></td>
<td><?php echo $f3; ?></td>
<td><?php echo $f4; ?></td>
<td><?php echo $f5; ?></td>
<td><?php echo $f6; ?></td>
<td><?php echo $f7; ?></td>
<td><?php echo $f8; ?></td>
<td><a href="<?php echo $f9; ?>" target="_blank"><?php echo $f9; ?></td>
<td><?php echo $f10; ?></td>
<td><?php echo $f11; ?></td>
</tr>

<?php
$i++;
}
?>

</tbody></table>
</div>
</body>
</html>
