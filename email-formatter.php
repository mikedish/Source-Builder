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
.main {margin-top: 90px;}
.ui-datepicker-today a {border: 1px solid #333 !important;}
label.error {color: #F00; width: 100%; text-align: left; display: none;}
input.error {border-color: #F00;}
#ATreminder, #ADreminder {color: #F00; display: none;}
textarea {
  height: 500px;
  width: 600px;
}
</style>

</head>
<body>
<?php include 'navbar.php'; ?>
  <div class="container main">
    <div class="row">
      <div class="span16">
        <h1>Email Formatter</h1>
        <form action="#" id="so-form" method="post">
          <fieldset>
            <div class="clearfix">
              <label for="email-text">Email Text</label><br /><br />
              <textarea id="email-text"></textarea>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  
    <div class="actions row">
      <input type="submit" id="submit" value="Generate" class="btn success" />
      <textarea id="generated-text" name="generated-text"></textarea>
      <input type="submit" value="copy" id="copy-dynamic" class="btn primary" />
    </div>

  </div>
    
<script src="js/jquery-1.6.1.min.js"></script> 
<script src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<script src="js/jquery.zclip.min.js"></script> 
<script src="js/bootstrap-twipsy.js"></script>
<script src="js/trilogy_form_tools.js"></script>
<script src="js/chosen.jquery.js"></script>

</body>

<script>

$(document).ready(function() {
  $('#submit').click(function() {

      console.log('Running');

      var emailText = $('#email-text').val();
      var s = emailText;

      // Codes can be found here:
      // http://en.wikipedia.org/wiki/Windows-1252#Codepage_layout
      s = s.replace( /\u2018|\u2019|\u201A|\uFFFD/g, "'" );
      s = s.replace( /\u201c|\u201d|\u201e/g, '"' );
      s = s.replace( /\u02C6/g, '^' );
      s = s.replace( /\u2039/g, '<' );
      s = s.replace( /\u203A/g, '>' );
      s = s.replace( /\u2013/g, '-' );
      s = s.replace( /\u2014/g, '--' );
      s = s.replace( /\u2026/g, '...' );
      s = s.replace( /\u00A9/g, '(c)' );
      s = s.replace( /\u00AE/g, '(r)' );
      s = s.replace( /\u2122/g, 'TM' );
      s = s.replace( /\u00BC/g, '1/4' );
      s = s.replace( /\u00BD/g, '1/2' );
      s = s.replace( /\u00BE/g, '3/4' );
      s = s.replace(/[\u02DC|\u00A0]/g, " ");

      console.log(s);

      $('#generated-text').val(s);

  });
});

</script>
</html>


