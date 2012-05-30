<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Trilogy Source Code Builder</title>
<link rel="ICON" href="favicon.ico" />
<link rel="SHORTCUT ICON" href="favicon.ico" />
<link rel="Stylesheet" href="css/jquery-ui-1.8.16.custom.css" type="text/css" />  
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/chosen.css" />
<style type="text/css">
.main {margin-top: 60px;}
.ui-datepicker-today a {border: 1px solid #333 !important;}
#generated-text {width: 300px;}
label.error {color: #F00; width: 100%; text-align: left; display: none;}
input.error {border-color: #F00;}
#ATreminder, #ADreminder {color: #F00; display: none;}
textarea {
  height: 200px;
  width: 600px;
}
.disabled-text {color: #CCC;}
textarea {
  height: 500px;
  width: 600px;
}
</style>
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/jquery-1.6.1.min.js"></script> 

<link rel="Stylesheet" href="https://assets.trilogyinteractive.com/shared/css/jquery-ui-1.8.16.custom.css" type="text/css" />
<link rel="stylesheet" href="https://assets.trilogyinteractive.com/shared/css/bootstrap.min.css">
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/jquery.tablesorter.min.js"></script> 
<script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/picnet.table.filter.min.js"></script> <script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/js/table2CSV.js"></script> 
<script src="js/jquery.zclip.min.js"></script> 
<script src="js/chosen.jquery.js"></script>
<script src="js/bootstrap-twipsy.js"></script>
<script src="js/trilogy_form_tools.js"></script>

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