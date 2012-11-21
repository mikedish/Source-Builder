$(document).ready(function() {
    var $form = $('form.validate')

    function output(code) {
      document.getElementById('generated').value = code
    }

    function platform() {
      if (document.getElementById('platform').checked) {
        return 'salse'
      } else {
        return false
      }
    }

    $('[value="ad"]').on('change', function(e) {
        $('.collapse.ad').collapse()
    })
    $('[value="add"]').on('change', function(e) {
      $('.collapse.addthis').collapse()
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

        generatedUrl = new Url
        generatedUrl.init(inputs)

      if ($form.valid()) {
            if (inputs.medium !== 'add') {
                output(generatedUrl.fullUrl())
            } else if (inputs.medium === 'add') {
                var generatedAddthisCode = new AddthisCode(generatedUrl, inputs.addthisProperties)
                output(generatedAddthisCode.fullCode())
            }
        }
    })
})