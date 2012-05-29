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
.disabled-text {color: #CCC;}
</style>

<?php
include('connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
$query = "SELECT * FROM `clients` ORDER BY `clients`.`Short Code` ASC"; 
$result = mysqli_query($dbc, $query)  or die("MySQL error: " . mysqli_error($dbc) . "<hr>\nQuery: $query");
$clients = array();
while ($row = mysqli_fetch_array($result)) {
		array_push($clients, $row);
	}


$client_num=mysqli_num_rows($result);


?>


</head>

<body>
<body>
<?php include 'navbar.php'; ?>
<div class="container main">

<form action="process.php" method="post" enctype="application/x-www-form-urlencoded" name="source-form" id="source-form">
<div class="row">
<div class="span8">
  <fieldset>
  <legend>URL Details</legend>
  <div class="clearfix">
  <label for="client">Client</label>
  <div class="input">
<!--  <input id="client" type="text" name="client" />-->
<select tabindex="1" style="width:225px;" data-placeholder="Choose a Client" class="client-choose" id="client" name="client">
                <option value=""></option> 
                <?php
                $z = 0;
while ($z < ($client_num)) {
	 ?>
     <option value="<?php echo($clients[$z]['Short Code']) ?>"><?php echo($clients[$z]['Display Name']) ?></option>
	<?php
	++$z;
}
	?>
                
             
              </select>
  </div>
  </div>
  <div class="clearfix">
  <label for="base">Base URL</label>
  <div class="input">
  <input id="base" type="text" name="base" />
  </div>
  </div>
  <div class="clearfix">
            <label id="optionsPlatform">Platform</label>
            <div class="input">
              <ul class="inputs-list">
              <li><label for="Platform" class="error">Please choose a platform</label></li>
                <li>
                  <label>
                    <input type="radio" name="Platform" value="Salsa" id="Platform_0" />
                    <span>Salsa</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="radio" name="Platform" value="Hub" id="Platform_1" />
                    <span>Hub</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="radio" name="Platform" value="BSD" id="Platform_1" />
                    <span>BlueState</span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="radio" name="Platform" value="ActBlue" id="Platform_2" />
                    <span>ActBlue</span>
                  </label>
                </li>
              </ul>
            </div>
        </div>  
        <div class="clearfix">
        
            <label id="GAlabel">Special</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input name="include-google" value="include-google" type="checkbox" checked="checked" />
                    <span>Include Google Analytics Parameters</span>
                  </label>
                </li> 
          		<li>
                  <label>
                    <input name="include-salsabk" value="include-salsabk" type="checkbox" />
                    <span>Include Salsa Blast Key (Salsa email only)</span>
                  </label>
                </li> 
              </ul>
            </div>
          </div>
           
<div class="clearfix">
            <label for="comments">Comments</label>
            <div class="input">
              <textarea class="large" name="comments" id="comments" rows="3" cols="30"></textarea>
            </div>
  </div>  
      
    </fieldset>
    </div>
    <div class="span8">
<fieldset>
<legend>Source Parameters</legend>
  <div class="clearfix">
            <label><span id="optionsMedium" data-placement="right" rel='twipsy' title='Choose the medium through which the supporter will take the action'>Medium</span></label>
            <div class="input">
              <ul class="inputs-list">
              <li><label for="Medium" class="error">Please choose a medium</label></li>
                <li>
                  <label for="Medium_0">
                    <input type="radio" name="Medium" value="ema_" id="Medium_0" />
                    <span data-placement="left" rel='twipsy' title='Use for links in emails'>Email</span>
                  </label>
                </li>
                <li>
                  <label  for="Medium_1">
                    <input type="radio" name="Medium" value="adv_" id="Medium_1" />
                    <span data-placement="left" rel='twipsy' title='Use for finish pages (e.g. donation source code) after a user has taken an action'>Advocacy</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_2">
                    <input type="radio" name="Medium" value="ad_" id="Medium_2" />
                    <span data-placement="left" rel='twipsy' title='Use for advertising links. Use the "Campaign" and "Additional" fields below for campaign and version information '>Advertising</span> <span id="ADreminder">Fill Out Additional Details Below</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_3">
                    <input type="radio" name="Medium" value="web_" id="Medium_3" />
                    <span data-placement="left" rel='twipsy' title='Use for interior website links (e.g. from a home page panel)'>Web</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_4">
                    <input type="radio" name="Medium" value="fb_" id="Medium_4" />
                    <span data-placement="left" rel='twipsy' title='Use for posts on Facebook by the campaign'>Facebook Post</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_5">
                    <input type="radio" name="Medium" value="fbs_" id="Medium_5" />
                    <span data-placement="left" rel='twipsy' title='Use for Facebook share links'>Facebook Share</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_6">
                    <input type="radio" name="Medium" value="tw_" id="Medium_6" />
                    <span data-placement="left" rel='twipsy' title='Use for posts on Twitter by the campaign'>Twitter Post</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_7">
                    <input type="radio" name="Medium" value="tws_" id="Medium_7" />
                    <span data-placement="left" rel='twipsy' title='Use for Twitter share links'>Twitter Share</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_8">
                   <input type="radio" name="Medium" value="add_" id="Medium_8" />
                    <span data-placement="left" rel='twipsy' title='Use for AddThis links, but consider using url_transform instead'>AddThis</span> <span id="ATreminder">Fill Out Additional Details Below</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_9">
                   <input type="radio" name="Medium" value="taf_" id="Medium_9" />
                    <span data-placement="left" rel='twipsy' title='Use for tell-a-friend share links in email triggers and TAF links'>Email Share (TAF)</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_10">
                   <input type="radio" name="Medium" value="lsh_" id="Medium_10" />
                    <span data-placement="left" rel='twipsy' title='Use for URLs that will be encoded through link shorteners'>Link Shortener</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_11">
                   <input type="radio" name="Medium" value="imp_" id="Medium_11" />
                    <span data-placement="left" rel='twipsy' title="Use for creating source codes for list imports (you'll need to manually pull the source code out of the URL">List Import</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_12">
                   <input type="radio" name="Medium" value="art_" id="Medium_12" />
                    <span data-placement="left" rel='twipsy' title="Use for autoresponse email triggers">Autoresponse Trigger</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_13">
                   <input type="radio" name="Medium" value="qrc_" id="Medium_13" />
                    <span data-placement="left" rel='twipsy' title="Use for pages linked from QR codes">QR Code</span>
                  </label>
                </li>
                <li>
                  <label for="Medium_14">
                   <input type="radio" name="Medium" value="par_" id="Medium_14" />
                    <span data-placement="left" rel='twipsy' title="Use for distributing tracked links to partners who are pushing out content">Partner</span>
                  </label>
                </li>
              </ul>
            </div>
        </div>  


<div class="clearfix">
  <label for="date"><span data-placement="right" rel='twipsy' title='For emails, use the date it will be sent. For all else, try to use the date that matches the start of the campaign'>Launch Date</span></label>
  <div class="input">
<input id="date" type="text" name="date" />
</div>
</div>
 
   <div class="clearfix">
  <label for="campaign"><span data-placement="right" rel='twipsy' title='Use to describe the issue theme (e.g. "ConfirmCordry") or other descriptive grouping (e.g. "EOQDec12"). No spaces!'>Campaign</span></label>
  <div class="input">
  <input id="campaign" type="text" name="campaign" />
  </div>
  </div> 
  
     <div class="clearfix">
  <label for="additional"><span data-placement="right" rel='twipsy' title='If you have additional details, such as testing segment, add them here'>Additional</span></label>
  <div class="input">
  <input id="additional" type="text" name="additional" />
  </div>
  </div> 
  
  </fieldset>
  </div>
  </div>
  
 



<div class="actions row">
    <input type="submit" id="submit" value="Generate" class="btn success" />
    <input type="text" id="generated-text" name="generated-text" />
    <input type="submit" value="copy" id="copy-dynamic" class="btn primary" />
    <input type="submit" value="log to database" id="log" class="btn danger" />
    <span id="status">
    </span>
</div>

<div id="addthis-code" class="actions row">


    <input id="addthis-generated" name="addthis-generated" />
    <input type="submit" value="copy addthis javascript snippet" id="copy-addthis" class="btn primary" />
</div>


 <div class="row">
<div class="span8" style="display: none;" id="addthis-details">
  <fieldset>
  <legend>Addthis Details</legend>
  <div class="clearfix">
  <label for="at_ga_ID">Google Analytics ID</label>
  <div class="input">
  <input id="at_ga_ID" type="text" name="at_ga_ID" />
  </div>
  </div>
  <div class="clearfix">
  <label for="at_twitter">Client Twitter</label>
  <div class="input">
  <input id="at_twitter" type="text" name="at_twitter" />
  </div>
  </div>
  <div class="clearfix">
  <label for="at_title">Title</label>
  <div class="input">
  <input id="at_title" type="text" name="at_title" />
  </div>
  </div>
  <div class="clearfix">
  <label for="at_description">Description</label>
  <div class="input">
  <input id="at_description" type="text" name="at_description" />
  </div>
  </div>
  </fieldset>
</div>  
<div class="span8" style="display: none;" id="additional-ad-params">
  <fieldset>
  <legend>Additional Ad Params</legend>
  <div class="clearfix">
  <label for="ad_Network">Network</label>
  <div class="input">
  <select name="ad_Network" id="ad_Network" data-placeholder="Choose a Network" style="width:225px;" >
  	 <option value="g">Google</option>
  	 <option value="fb">Facebook</option>
     <option value="y">Yahoo</option>
     <option value="b">Bing</option>
  </select>
 <!-- <input id="ad_Network" type="text" name="ad_Network" />-->
  </div>
  </div>
  <div class="clearfix">
  <label for="ad_Geo">Geo Targeting</label>
  <div class="input">
  <input id="ad_Geo" type="text" name="ad_Geo" />
  </div>
  </div>
  <div class="clearfix">
  <label for="ad_Flight">Flight</label>
  <div class="input">
  <input id="ad_Flight" type="text" name="ad_Flight" />
  </div>
  </div>
  <div class="clearfix">
  <label for="ad_Variation">Variation</label>
  <div class="input">
  <input id="ad_Variation" type="text" name="ad_Variation" />
  </div>
  </div>
    <div class="clearfix">
  <label for="ad_Additional">Additional</label>
  <div class="input">
  <input id="ad_Additional" type="text" name="ad_Additional" />
  </div>
  </div>
  </fieldset>
</div>

  </div>

</form>

</div>

<script src="js/jquery-1.6.1.min.js"></script> 
<script src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<script src="js/jquery.zclip.min.js"></script> 
<script src="js/bootstrap-twipsy.js"></script>
<script src="js/trilogy_form_tools.js"></script>
<script src="js/chosen.jquery.js"></script>
<script>
$(document).ready(function() {
	// datepicker initialization
    $("#date").datepicker({
        dateFormat: 'yymmdd'
    }); 
	// client list generation
	
	function setAddthisParams() {
		// fill addthis google analytics and twitter fields where applicable
		var clients_json = <? echo json_encode($clients); ?>;
        var client_short = $('.client-choose').val();
		var k;
		for (k = 0; k < clients_json.length; ++k) {
		 if (client_short === clients_json[k]['Short Code']) {
			var row_num = k;
			}
		}	
		var client_short = clients_json[row_num]['Short Code'];
		var client_name = clients_json[row_num]['Display Name'];
		var client_twitter = clients_json[row_num]['Twitter Handle'];
		var client_gaID = clients_json[row_num]['Google Analytics ID'];
		$('input[name="at_ga_ID"]').val(client_gaID);
		if (client_twitter !== '') {
			$('input[name="at_twitter"]').val('@' + client_twitter);
		} else {
			$('input[name="at_twitter"]').val('');
		}
	}
	if ($('.client-choose').val() !== '') { // don't run if client isn't set
		setAddthisParams();
	}
	// chosen initializations
    $('#ad_Network').chosen();
    $('.client-choose').chosen().change(function(){
		setAddthisParams(); 
	});
	//Addthis and ad parameters fieldsets
    if ($('#Medium_8').prop('checked') === true) {
        $('#addthis-details').slideDown();
        $('#ATreminder').fadeIn();
    }
    if ($('#Medium_2').prop('checked') === true) {
        $('#additional-ad-params').slideDown();
        $('#ADreminder').fadeIn();
    }
    $('input[name="Medium"]').change(function() {
		// addthis case
        if ($('#Medium_8').prop('checked') === true) {
            $('#addthis-details').slideDown();
            $('#ATreminder').fadeIn();
            $('#ADreminder').fadeOut();
            $('#additional-ad-params').slideUp();
            $('input[name="date"],input[name="campaign"],input[name="additional"]').removeAttr('disabled');
            $('label[for="date"],label[for="campaign"],label[for="additional"]').removeClass('disabled-text');
		// ads case
        } else if ($('#Medium_2').prop('checked') === true) {
            $('#additional-ad-params').slideDown();
            $('#addthis-details').slideUp();
            $('#ADreminder').fadeIn();
            $('#ATreminder').fadeOut();
            $('input[name="date"],input[name="campaign"],input[name="additional"]').attr('disabled', 'true');
            $('label[for="date"],label[for="campaign"],label[for="additional"]').addClass('disabled-text');
		// hide extra fields for all other cases
        } else {
            $('#addthis-details,#additional-ad-params').slideUp();
            $('#ATreminder').fadeOut();
            $('#ADreminder').fadeOut();
            $('input[name="date"],input[name="campaign"],input[name="additional"]').removeAttr('disabled');
            $('label[for="date"],label[for="campaign"],label[for="additional"]').removeClass('disabled-text');
        }
    }); 
	// copy to clipboard buttons
    $('#copy-dynamic').zclip({
        path: '/swf/ZeroClipboard.swf',
        copy: function() {
            return $('input#generated-text').val();
        }
    });
    $('#copy-addthis').zclip({
        path: '/swf/ZeroClipboard1.swf',
        copy: function() {
            return $('input#addthis-generated').val();
        }
    });
    $('#copy-adparams').zclip({
        path: '/swf/ZeroClipboard2.swf',
        copy: function() {
            return $('input#adparams-generated').val();
        }
    }); 
	// form validation
    jQuery.validator.addMethod("noSpace",
    function(value, element) {
        return value.indexOf(" ") < 0;
    },"No spaces please");
    $('#source-form').validate({
        rules: {
            client: "required",
            base: {
                required: true,
                url: true
            },
            Platform: "required",
            Medium: "required",
            campaign: "noSpace",
            additional: "noSpace"
        },
        messages: {
            client: "Please include the client name",
            base: {
                require: "The base URL is required",
                url: "Must be a valid URL"
            },
            Platform: "Please choose your client's platform",
            Medium: "Please choose a medium",
            campaign: "No spaces are allowed",
            additional: "No spaces are allowed"
        }
    });
	// Source code generator functions
	$('#source-form').submit(function(e) {
		e.preventDefault();
		if ($(this).valid()) {
			var medium = $('input[name="Medium"]:checked').val();
			var campaign = $('#campaign').val();
			var source = medium + $('#date').val() + campaign + $('#additional').val();
			if ($('input[name="include-salsabk"]').prop('checked') === true && $('#Medium_0').prop('checked') === true && $('input[name="Platform"]:checked').val() === "Salsa") {
				source += 'bk[[email_blast_KEY]]'
			}
			if (campaign === '') {
				campaign = 'none';
			}
			var GAparams = '&utm_source=' + source + '&utm_medium=' + medium + '&utm_campaign=' + campaign;
			var platform = $('input[name="Platform"]:checked').val();
			switch (platform) {
				case 'Salsa': 
					var shortlinks = new RegExp('\\?');
					if (shortlinks.test($('#base').val())) {
						var base = $('#base').val() + "&track=";
					} else {
						var base = $('#base').val() + "?track=";
					}
					var value = base + source + "&tag=" + source;
					break;
				case 'Hub':
					var base = $('#base').val() + "?sc=";
					var value = base + source;
					break;
				case 'BSD':
					var base = $('#base').val() + "?source=";
					var value = base + source;
					break;
				case 'ActBlue': 
					var base = $('#base').val() + "?refcode=";
					var value = base + source;
					break;
			}
			if ($('input[name="include-google"]').is(':checked')) {
				value += GAparams;
			}
			// build addthis code snippet
			if ($('#Medium_8').prop('checked') === true) {
				var addthis;
				var addthisTwitter;
				var addthisSourceParam;
				var addthisTag = '';
				if ($('input[name="at_twitter"]').val() === '') {
					addthisTwitter = '';
				}
				else {
					addthisTwitter = 'templates: {twitter: "RT ' + $('input[name="at_twitter"]').val() + ' {{title}}: {{url}}"},';
				}
				switch (platform) {
					case 'Salsa':
						addthisSourceParam = 'track';
						addthisTag = 'tag: "' + source + '_{{code}}",';
						break;
					case 'Hub':
						addthisSourceParam = 'sc';
						break;
					case 'BSD':
						addthisSourceParam = 'source';
						break;
					case 'ActBlue':
						addthisSourceParam = 'refcode';
						break;
				}
				addthis = '<script type="text/javascript">var addthis_config = {data_ga_property: "' + $('#at_ga_ID').val() + '",data_ga_social : true,data_track_clickback: true};var addthis_share = {url: "' + $('#base').val() + '",title: "' + $('#at_title').val() + '",description: "' + $('#at_description').val() + '",' + addthisTwitter + ' url_transforms: {add: {' + addthisTag + addthisSourceParam + ': "' + source + '_{{code}}", utm_source: "' + source + '_{{code}}", utm_medium: "qat",utm_campaign: "' + campaign + '"}}};<\/script>';
				$('#addthis-generated').val(addthis);
			} 
			// build advertising string
			if ($('#Medium_2').prop('checked') === true) {
				var adsource = $('#ad_Network').val() + '_' + $('#ad_Geo').val() + '_' + $('#ad_Flight').val() + '_' + $('#ad_Variation').val() + '_' + $('#ad_Additional').val();
				if (platform === 'Hub' || platform === 'BSD' || platform === 'ActBlue') {
					value = base + medium + adsource;
				} else {
					value = base + medium + adsource + '&tag=' + medium + adsource;
				}
			} // build list import string
			if ($('#Medium_11').prop('checked') === true) {
				value = source;
			}
			$('#generated-text').val(value);
		}
	}); 
	// submit info to database
    $('#log').click(function(e) {
        e.preventDefault();
        var formData = $('#source-form').serialize();
        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: formData,
            success: function(data) {
                $('#status').html('<img src="/img/success.png" /><br /><span class="help-inline" style="color: #468847">' + data + '</span>');
            }
        });
    });
});
</script>
</body>
</html>
