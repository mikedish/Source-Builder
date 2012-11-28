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
   
    function collapseShow(element) {
       var selector = '.collapse.' + element.value
       $(selector).collapse('show')
    }
    function collapseHide(element) {
       $('.collapse.in').collapse('hide') 
    }
    
    function addEventListenerAll(elements, eventName, eventFunction) {
        for (i = 0; i < elements.length; i++) {
            elements[i].addEventListener(eventName, eventFunction.bind(null, elements[i])) 
        }
    }
 
    addEventListenerAll(document.querySelectorAll('[value="ad"], [value="add"]'), 'click', collapseShow)
    addEventListenerAll(document.querySelectorAll('[name="medium"]'), 'click', collapseHide)
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
