$(document).ready(function() {
    var sourceClip = new ZeroClipboard.Client(),
    nameClip = new ZeroClipboard.Client()

    sourceClip.glue('copy-url')
    sourceClip.addEventListener('onMouseDown', function(client, text) {
         sourceClip.setText(document.getElementById('generated').value)
    })
    sourceClip.addEventListener( 'onComplete', function(client, text) {
        alert("Copied text to clipboard: " + text )
    })

    nameClip.glue('copy-email-name')
    nameClip.addEventListener('onMouseDown', function(client, text) {
      nameClip.setText(document.getElementById('generated-email-name').value)
    })
    nameClip.addEventListener('onComplete', function(client, text) {
      alert("Copied email name to clipboard")
    }) 

    $('[name="date"]').datepicker({ format: 'yyyy-mm-dd' }).on('changeDate', function(e) {
        $(this).datepicker('hide')
    })
    createClientDropdown()

    function createClientDropdown() {
        for (client in clients) {
          var dropdown = '<option value="' + client + '">' + clients[client].displayName + '</option>'
          $('#client').append(dropdown)
        }
    }
    function emailName(inputs) {
        var type = inputs.emailProperties.type.toUpperCase(),
        description = inputs.emailProperties.description.toUpperCase(),
        source = generatedUrl.sourceCode().replace('bk[[email_blast_KEY]]', '')
        return type + ': ' + source + ' ' + description 
    }
        
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
       if (event.target.value === 'ema') {
           $('#email-name').collapse('show')
       }
    }
    function collapseHide(event) {
       $('.collapse.in').collapse('hide')
       $('#email-name').collapse('hide')
    }
    
    $('.collapse').on('shown', function () {
        nameClip.reposition() 
        sourceClip.reposition()
    }) 
    $('.collapse').on('hidden', function() {
        nameClip.reposition()
        sourceClip.reposition()
    })  
 
    document.querySelectorAll('[value="ad"], [value="add"], [value="ema"]').addEventListenerAll('click', collapseShow)
    document.querySelectorAll('[name="medium"]').addEventListenerAll('click', collapseHide)
    document.querySelector('[value="imp"]').addEventListener('click', function() { $('#base').removeClass('required') })
    document.getElementById('generate-url').addEventListener('click', buildSource)

    function buildSource(e) {
        e.preventDefault()
        inputs = {
            base: document.getElementById('base').value,
            client: $('#client').val(),
            platform: platform(),
            receivingPlatform: document.getElementById('receiving-platform').value,
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
            },
            emailProperties: {
                type: document.getElementById('emailProperties[type]').value,
                description: document.getElementById('emailProperties[description]').value
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
            } else if (inputs.medium == 'ema') {
              document.getElementById('generated-email-name').value = emailName(inputs)
              output(generatedUrl.fullUrl())
            } else {
                output(generatedUrl.fullUrl())
            }
        }
    }
})
