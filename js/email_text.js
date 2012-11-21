var EmailText = function(options) {
    this.init(options)
}

EmailText.prototype = {
    init: function(options) {
        this.text = options.text
        this.callout = options.callout
    },

    removeSpecialChars: function() {
      var newText =
        this.text.replace( /\u2018|\u2019|\u201A|\uFFFD/g, "'" )
        .replace( /\u201c|\u201d|\u201e/g, '"')
        .replace( /\u02C6/g, '^' )
        .replace( /\u2039/g, '<' )
        .replace( /\u203A/g, '>' )
        .replace( /\s\u2013\s/g, '--' )
        .replace( /\s\u2014\s/g, '--' )
        .replace( /\u2026/g, '...' )
        .replace( /\u00A9/g, '(c)' )
        .replace( /\u00AE/g, '(r)' )
        .replace( /\u2122/g, 'TM' )
        .replace( /\u00BC/g, '1/4' )
        .replace( /\u00BD/g, '1/2' )
        .replace( /\u00BE/g, '3/4' )
        .replace(/[\u02DC|\u00A0]/g, " ")
        .replace(/[ ]+/g, " ")

        this.text = newText
        return this
    },

    addHTML: function() {
      this.text = this.text.replace(/\n\n/g, "\n</p><p>\n").replace(/(\w)\n(\w)/g, "$1<br />\n$2")
      return this
    },

    calloutHtml: function() {
      if (this.callout) {
        return this.callout.tableTags()
      }
    },

    format: function() {
      return this.calloutHtml() + '<p>' + this.removeSpecialChars().addHTML().text + '</p>'
    }
}