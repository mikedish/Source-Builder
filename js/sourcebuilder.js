$(document).ready(function() {
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

    $('[value="ad"], [value="add"]').on('change', function(e) {
        var selector = '.collapse.' + this.value
        $(selector).collapse('show')
    })
    $('[name="medium"]').on('click', function(e) {
        $('.collapse.in').collapse('hide')
    })
    $('[value="imp"]').on('change', function(e) {
        $('#base').removeClass('required')
    })
   

    $('#generate-url').on('click', function(e) {
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
    })
})
