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
    <div class="topbar">
      <div class="fill">
        <div class="container">
           <img src="img/trilogy-labs.png" height="40" width="296" />
          <a class="brand" href="/">Source Code Builder</a>
          <ul class="nav">
            <li><a href="/">Home</a></li>
            <li><a href="/source-list.php">Source Code Log</a></li>
            <li><a href="/clientlist.html">Client Database</a></li>
            <li class="active"><a href="/sharegenerators.php">Share Generators</a></li>
          </ul>

        </div>
      </div>

    </div>
    <div class="container main">
    <div class="row">
     <div class="span16">
    <form action="#" id="so-form" method="post">
    <fieldset>
    <legend>Facebook Share Override</legend>
    <div class="clearfix">
  <label for="soUrl"><span data-placement="right">URL</span></label>
  <div class="input">
<input id="soUrl" type="text" name="soUrl" />
</div>
</div>
 
   <div class="clearfix">
  <label for="soTitle"><span data-placement="right">Title</span></label>
  <div class="input">
  <input id="soTitle" type="text" name="soTitle" />
  </div>
  </div> 
  
     <div class="clearfix">
  <label for="soImageUrl"><span data-placement="right">Image URL</span></label>
  <div class="input">
  <input id="soImageUrl" type="text" name="soImageUrl" />
  </div>
  </div> 
       <div class="clearfix">
  <label for="soDescription"><span data-placement="right">Description</span></label>
  <div class="input">
  <input id="soDescription" type="text" name="soDescription" />
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

<!--Twitter Share section-->

<div class="row">
     <div class="span16">
    <form action="#" id="tw-form" method="post">
    <fieldset>
    <legend>Twitter Intent Link Builder</legend>
    <div class="clearfix">
  <label for="twText"><span data-placement="right">Tweet Text</span></label>
  <div class="input">
<input id="twText" type="text" name="twText" />
</div>
</div>
 
 
  </fieldset>
  </form>
  </div></div>
  
  <div class="actions row">
    <input type="submit" id="tw-submit" value="Generate" class="btn success" />
    <input type="text" id="tw-generated-text" name="tw-generated-text" />
    <input type="submit" value="copy" id="tw-copy-dynamic" class="btn primary" />
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
	$('#tw-copy-dynamic').zclip({
        path: '/swf/ZeroClipboard.swf',
        copy: function() {
            return $('input#tw-generated-text').val();
        }
    });
	$('#so-form').validate({
                rules: {
					soTitle: "required",
					soUrl: {
						required: true,
						url: true
					},
					soImageUrl: {
						required: true,
						url: true
					},
					soDescription: "required"
				},
                messages: {
					soTitle: "Please include a title",
					soUrl: {
						required: "Please include the URL",
						url: "Invalid URL"
					},
					soImageUrl: {
						required: "Please include the image URL",
						url: "Invalid URL"
					},
					soDescription: "Please include a description"
				}
    });
	$('#so-submit').click(function(e) {
		e.preventDefault;
		if($('#so-form').valid()) {
		var soGenerated = 'http://www.facebook.com/sharer.php?s=100&p[title]=' + $('#soTitle').val() + '&p[url]=' + $('#soUrl').val() + '&p[images][0]=' + $('#soImageUrl').val() + '&p[summary]=' + $('#soDescription').val();
		var encodedSoGenerated = encodeURI(soGenerated)
		$('#so-generated-text').val(encodedSoGenerated);
		}
	});
	$('#tw-submit').click(function(e) {
		e.preventDefault;
		if($('#tw-form').valid()) {
		var twGenerated = 'https://twitter.com/intent/tweet?status=' + $('#twText').val();
		var encodedTwGenerated = encodeURI(twGenerated)
		$('#tw-generated-text').val(encodedTwGenerated);
		}
	});
	
	
	
});
</script>
</body>
</html>


