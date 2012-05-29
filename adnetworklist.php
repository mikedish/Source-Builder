<!doctype html>
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
</style>

</head>
<body>
<body>
<? include 'navbar.php'; ?>

    </div>
    <div class="container main">
    <div class="row">
     <div class="span16">
    <form action="#" id="so-form" method="post">
    <fieldset>
    <legend>Facebook Share Override</legend>
    <div class="clearfix">
  <label for="so-url"><span data-placement="right">URL</span></label>
  <div class="input">
<input id="so-url" type="text" name="so-url" />
</div>
</div>
 
   <div class="clearfix">
  <label for="so-title"><span data-placement="right">Title</span></label>
  <div class="input">
  <input id="so-title" type="text" name="so-title" />
  </div>
  </div> 
  
     <div class="clearfix">
  <label for="so-image-url"><span data-placement="right">Image URL</span></label>
  <div class="input">
  <input id="so-image-url" type="text" name="so-image-url" />
  </div>
  </div> 
       <div class="clearfix">
  <label for="so-description"><span data-placement="right">Description</span></label>
  <div class="input">
  <input id="so-description" type="text" name="so-description" />
  </div>
  </div> 
  
  </fieldset>
  </form>
  </div></div>
  
  <div class="actions row">
    <input type="submit" id="so-submit" value="Generate" class="btn success" />
    <input type="text" id="so-generated-text" name="so-generated-text" />
    <input type="submit" value="copy" id="copy-dynamic" class="btn primary" />
</div>

</div>
  
<script src="js/jquery-1.6.1.min.js"></script> 
<script src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<script src="js/jquery.zclip.min.js"></script> 
<script src="js/bootstrap-twipsy.js"></script>
<script src="js/trilogy_form_tools.js"></script>
<script src="js/chosen.jquery.js"></script>
<script>
$(document).ready(function() {
	    $('#copy-dynamic').zclip({
        path: '/swf/ZeroClipboard.swf',
        copy: function() {
            return $('input#so-generated-text').val();
        }
    });
	$('#so-submit').click(function(e) {
		e.preventDefault;
		var soGenerated = 'http://www.facebook.com/sharer.php?s=100&p[title]=' + $('#so-title').val() + '&p[url]=' + $('#so-url').val() + '&p[images][0]=' + $('#so-image-url').val() + '&p[summary]=' + $('#so-description').val();
		$('#so-generated-text').val(soGenerated);
	});
});
</script>

</body>
</html>


