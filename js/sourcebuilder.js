$(document).ready(function() {
    var clip = new ZeroClipboard.Client()
    clip.glue('copy-url')
    clip.addEventListener('onMouseDown', function(client, text) {
         clip.setText(document.getElementById('generated').value)
    })
    clip.addEventListener( 'onComplete', function(client, text) {
        alert("Copied text to clipboard: " + text )
    })

    $('[name="date"]').datepicker({ format: 'yyyy-mm-dd'})

    function output(code) {
        document.getElementById('generated').value = code
    }

    function platform() {
      if (document.getElementById('platform').checked) {
          return 'salsa'
      } else {
          return false
      }
    }
   
    function collapseShow(event) {
       var selector = '.collapse.' + event.target.value
       $(selector).collapse('show')
    }
    function collapseHide(event) {
       $('.collapse.in').collapse('hide')
    }
    
    $('.collapse').on('shown', function () {
        clip.reposition()
    }) 
    $('.collapse').on('hidden', function() {
        clip.reposition()
    })  
 
    document.querySelectorAll('[value="ad"], [value="add"]').addEventListenerAll('click', collapseShow)
    document.querySelectorAll('[name="medium"]').addEventListenerAll('click', collapseHide)
    document.querySelector('[value="imp"]').addEventListener('click', function() { $('#base').removeClass('required') })
    document.getElementById('generate-url').addEventListener('click', buildSource)

    function buildSource(e) {
        e.preventDefault()
        inputs = {
            base: document.getElementById('base').value,
            client: $('#client').val(),
            platform: platform(),
            medium: $('input[name=medium]:checked').val(), 
            date: document.getElementById('date').value,
            campaign: document.getElementById('campaign').value,
            additional: document.getElementById('additional').value,
            adProperties: {
                network: document.getElementById('adProperties[network]').value,
                geoTargeting: document.getElementById('adProperties[geoTargeting]').value,
                flight: document.getElementById('adProperties[flight]').value,
                variation: document.getElementById('adProperties[variation]').value
            },
            addthisProperties: {
                title: document.getElementById('addthisProperties[title]').value,
                description: document.getElementById('addthisProperties[description]').value
            }
        }  

        generatedUrl = new Url(inputs)
        
        if ($('form.validate').valid()) {
//        if (true) {
            if (inputs.medium === 'add') {
                var generatedAddthisCode = new AddthisCode(generatedUrl)
                output(generatedAddthisCode.fullCode())
            } else if (inputs.medium === 'imp') {
                output(generatedUrl.sourceCode())
            } else {
                output(generatedUrl.fullUrl())
            }
        }
    }
})
