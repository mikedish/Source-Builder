$(document).ready(function() {
    var tweet = document.getElementById('tweet'),
    facebook_clip = new ZeroClipboard.Client(),
    twitter_clip = new ZeroClipboard.Client()

    facebook_clip.addEventListener('onComplete', function(client, text) {
        alert("Copied Facebook link to clipboard.")
    })
    facebook_clip.addEventListener('onMouseDown', function(client, text) {
        facebook_clip.setText(document.getElementById('generated-facebook').value)
    })

    twitter_clip.addEventListener('onMouseDown', function(client, text) {
        twitter_clip.setText(document.getElementById('generated-twitter').value)
    })
    twitter_clip.addEventListener('onComplete', function(client, text) {
        alert("Copied Twitter link to clipboard.")
    })

    facebook_clip.glue('copy-facebook')
    twitter_clip.glue('copy-twitter')
    
    $.validator.methods.tweetLength = function(value, element, param) {
        return charCountdown(value) >= 0
    }

    $('#twitter').validate({
        rules: {
            tweet: {
                tweetLength: true
            }
        },
        messages: {
            tweet: 'Sorry, you are over the maximum Tweet length.'
        },
        submitHandler: generateTwitter
    })

    $("#facebook").validate({
        submitHandler: generateFacebookUrl
    })

    tweet.addEventListener('keyup', showCharsLeft)

    function showCharsLeft(event) {
        var tweet = event.target.value,
        charsBox = document.getElementById('tweet-chars-left'),
        charsLeft = charCountdown(tweet)
        charsBox.innerHTML = charsLeft
    }

    function generateTwitter(form) {
      var encodedUrl = encodeURIComponent(form["tweet"].value),
      tweetUrl = 'http://twitter.com/intent/tweet?text='
      form["generated-twitter"].value = tweetUrl + encodedUrl
    }

    function charCountdown(value) {
        var body = value,
        URL_RE = 'https?://[^ \\n]+[^ \\n.,;:?!&\'"’”)}\\]]'
        charsLeft = 140 - body.length,
        urlRE = new RegExp(URL_RE, 'g'),
        matches = body.match(urlRE);
        if (matches) {
            charsLeft -= matches.length*20;
            charsLeft += matches.join('').length;
        }
        return charsLeft
    }

     function generateFacebookUrl(form) {
        var fbBase = 'http://www.facebook.com/sharer.php?s=100&p[title]=',
        title = encodeURIComponent(form["title"].value),
        urlJoin = '&p[url]=',
        encodedUrl = encodeURIComponent(form["base"].value),
        imageJoin = '&p[images][0]=',
        encodedImageUrl = encodeURIComponent(form["image-url"].value),
        descriptionJoin = '&p[summary]=',
        description = encodeURIComponent(form["description"].value)
        form["generated-facebook"].value = fbBase + title + urlJoin + encodedUrl + imageJoin + encodedImageUrl + descriptionJoin + description
     }
})
