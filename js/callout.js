var Callout = function(options) {
    this.init(options)
}

Callout.prototype = {
    init: function(options) {
        this.widthFromPixels(options.width)
        this.heightFromPixels(options.height)
        this.alt = options.alt
        this.url = options.url
        this.link = options.link
    },

    validateOptions: function() {
        if (this.url) {
            return true
        } else {
           return false
        }
    },

    widthFromPixels: function(width) {
        this.width = width
    },

    heightFromPixels: function(height) {
       this.height = height
    },

    widthInPixels: function() {
        return this.width
    },

    heightInPixels: function() {
        return this.height
    },

    imageTag: function() {
      var textArray = []
      textArray.push('<img height="')
      textArray.push(this.heightInPixels())
      textArray.push('" border="0" width="')
      textArray.push(this.widthInPixels())
      textArray.push('" src="')
      textArray.push(this.url)
      textArray.push('" alt="')
      textArray.push(this.alt)
      textArray.push('" class="callout" />')
      return textArray.join('')
    },

    linkTag: function() {
      var textArray = []
      textArray.push('<a href="')
      textArray.push(this.link)
      textArray.push('" target="_blank" name="link" class="callout">')
      textArray.push(this.imageTag())
      textArray.push('</a>')
      return textArray.join('')
    },

    tableTags: function() {
        if (this.validateOptions()) {
            var textArray = []
            textArray.push('<table align="right" style="width: auto; padding: 0px 0px 10px 10px" class="callout"><tbody><tr><td>')
            textArray.push(this.linkTag())
            textArray.push('</td></tr></tbody></table>\n')
            return textArray.join('')
        } else {
            return ''
        }
    }
}
