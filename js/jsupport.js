NodeList.prototype.addEventListenerAll = function(eventName, callback) {
    for (i = 0; i < this.length; i++) {
        this[i].addEventListener(eventName, callback)
    }
}

HTMLFormElement.prototype.params = function() {
    var params = {}
    
    function isRadioOrCheckbox(element) {
        if ((element.type === 'RADIO') || (element.type === 'CHECKBOX')) {
            return true
        }
    }
    
    function isInput(element) {
        if (element.tagName == 'INPUT') {
            if (isRadioOrCheckbox(element)) {
                return element.checked
            } 
            return true
        } else if (element.tagName === 'SELECT') {
            return true
        } else if (element.tagName === 'TEXTAREA') {
            return true
        }
     }
    
    function nameToArray(name) {
        if (typeof name !== 'string') {
            return name.replace(']','').split('[')
        }
    }
 
    function addInputToParams(element, paramsHash) {
        console.log (element)
        var inputArray = nameToArray(element.name)
        //loop through the params
        for (inputKey = 0; inputKey < inputArray.length; inputKey++) {
            var currentInput = inputArray[inputKey],
            nextInput = inputArray[inputKey + 1] 
            //compare the first element of the array to the topmost keys
            for ( paramsKey in paramsHash) {
                if (paramsHash.hasOwnProperty(paramsKey)) {
                    if (paramsKey == currentInput) {
                        paramsKey[currentInput][nextInput]
                        addInputToParams(element.slice(2), paramsKey)
                    }
                }
             }
         }
    }

    function inputValue(element) {
        var val
        switch (element.tagName) {
           case 'INPUT':
               val = element.value
               break
           case 'SELECT':
               val = element.options[element.selectedIndex].value
               break
           case 'TEXTAREA':
               val = element.value
               break
        }
        return val
    }
 
    function getInputElements(nodeElement) {
        if (isInput(nodeElement)) {
            return nodeElement 
        } else if (nodeElement.elements && (nodeElement.elements.length > 0)) {
            console.log(nodeElement)
            for (i = 0; i < nodeElement.elements.length; i++) {
                console.log(nodeElement.elements[i])
                getInputElements(nodeElement.elements[i])
             }
         }
    }

    var inputElements = getInputElements(this)
    for (i = 0; i < inputElements.length; i++) {
        addInputToParams(inputElements, params)
    } 
    return params
}
