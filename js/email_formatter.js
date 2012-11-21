$(document).ready(function() {
    $('#generate-email').click(function(e) {
        e.preventDefault()

        if ($('form.validate').valid()) {
            var calloutHtml = new Callout({
                width: document.getElementById('calloutProperties[width]').value,
                url: document.getElementById('calloutProperties[url]').value,
                height: document.getElementById('calloutProperties[height]').value,
                alt: document.getElementById('calloutProperties[alt]').value  
            }),
            emailHtml = new EmailText({
                text: document.getElementById('text').value,
                callout: calloutHtml
            })
            document.getElementById('generated-html').value = emailHtml.formatHtml()
            document.getElementById('generated-text').value = emailHtml.formatText()
        }
    })
})
