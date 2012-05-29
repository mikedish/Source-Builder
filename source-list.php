<!doctype html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Source Log</title>
<link rel="ICON" href="favicon.ico" />
<link rel="SHORTCUT ICON" href="favicon.ico" />
<link rel="Stylesheet" href="css/jquery-ui-1.8.16.custom.css" type="text/css" />  
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/chosen.css" />
<style type="text/css">
.main {margin-top: 90px;}
.ui-datepicker-today a {border: 1px solid #333 !important;}
#generated-text {width: 300px;}
label.error {color: #F00; width: 100%; text-align: left; display: none;}
input.error {border-color: #F00;}
#ATreminder, #ADreminder {color: #F00; display: none;}
</style>


<link rel="Stylesheet" href="https://assets.trilogyinteractive.com/shared/css/jquery-ui-1.8.16.custom.css" type="text/css" />
<link rel="stylesheet" href="https://assets.trilogyinteractive.com/shared/css/bootstrap.min.css">
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/jquery-1.6.1.min.js"></script> 
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/jquery.tablesorter.min.js"></script> 
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/picnet.table.filter.min.js"></script> <script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/table2CSV.js"></script> 
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#log-table").tablesorter( {sortList: [[10,1]]} ).tableFilter();
		$("#csv-generator").click(function(e){
			e.preventDefault;
			$("#log-table").table2CSV(); 
		});
    } 
); 
</script>

</head>

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
