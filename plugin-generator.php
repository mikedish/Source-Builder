<!doctype html>
<? include 'head.php' ?>

<body>
<?php include 'navbar.php'; ?>
  <div class="container main">
    <div class="row">
      <div class="span16">
        <h1>Plugin Generator</h1>
        <form action="#" id="so-form" method="post">
          <fieldset>
            <div class="clearfix">
              <label for="validate">Validate:</label>
              <input type="checkbox" id="validate" value="true" />
            </div>
            <div class="clearfix">
              <label for="buttonText">Button Text:</label>
              <input type="text" id="buttonText" />
            </div>
            <div class="clearfix">
              <label for="prettify">Prettify:</label>
              <input type="checkbox" id="prettify" value="true" />
            </div>
            <div class="clearfix">
              <label for="restructure">Restructure:</label>
              <input type="checkbox" id="restructure" value="true" />
            </div>
            <div class="clearfix">
              <label for="responsive">Responsive:</label>
              <input type="checkbox" id="responsive" value="true" />
            </div>
            <div class="clearfix">
              <label for="mobile">Mobile:</label>
              <input type="checkbox" id="mobile" value="true" />
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
    console.log('running');
    var fullString = '';

    var beginning = '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"><\/script><script type="text/javascript" src="https://assets.trilogyinteractive.com/shared/jquery-salsaforms-1-0/salsaforms.js"><\/script><script>$(document).ready(function(){$.salsaform({';
    var end = '});});<\/script>';
    
    fullString += beginning;

    $.each($('input:checked'), function(index, value) {
      var element = $(value)
      fullString += element.attr('id')+':true,'
    });

    $.each($('[type="text"]'), function(index, value) {
      var element = $(value);
      if (element.val().length > 0) {
        fullString += element.attr('id')+':\''+element.val()+'\'';
      }
    });

    fullString += end;

    $('#generated-text').val(fullString);

  });

});

</script>
</html>