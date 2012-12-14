$(document).ready(function() {
    var html_clip = new ZeroClipboard.Client(),
    text_clip = new ZeroClipboard.Client()

    html_clip.addEventListener('onComplete', function(client, text) {
        alert("Copied HTML version to clipboard")
    })
    html_clip.addEventListener('onMouseDown', function(client, text) {
        html_clip.setText(document.getElementById('generated-html').value)
    })
    text_clip.addEventListener('onComplete', function(client, text) {
        alert("Copied text version to clipboard")
    })
    text_clip.addEventListener('onMouseDown', function(client, text) {
        text_clip.setText(document.getElementById('generated-text').value)
    })
    html_clip.glue('copy-html')
    text_clip.glue('copy-text')

    document.getElementById('generate-email').addEventListener('click', formatText)

    function formatText(e) {
        e.preventDefault()

        if ($('form.validate').valid()) {
            var calloutHtml = new Callout({
                width: document.getElementById('calloutProperties[width]').value,
                url: document.getElementById('calloutProperties[url]').value,
                height: document.getElementById('calloutProperties[height]').value,
                alt: document.getElementById('calloutProperties[alt]').value, 
                link: document.getElementById('calloutProperties[link]').value
            }),
            emailHtml = new EmailText({
                text: document.getElementById('text').value,
                callout: calloutHtml
            })
            document.getElementById('generated-html').value = emailHtml.formatHtml()
            document.getElementById('generated-text').value = emailHtml.formatText()
        }
    }
})
