var EmailText = function(options) {
    this.init(options)
}

EmailText.prototype = {
    init: function(options) {
        this.rawText = options.text
        this.callout = options.callout
    },

    removeSpecialChars: function() {
      return this.rawText
        .replace( /\u2018|\u2019|\u201A|\uFFFD/g, "'" )
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
    },

    addHTML: function() {
        return '<p>\n' + this.miscFormatting().replace(/\n\s*\n/g, "\n</p><p>\n").replace(/(\w)\n(\w)/g, "$1<br />\n$2") + '\n</p>'
    },

    miscFormatting: function() {
      return this.removeSpecialChars().replace(/(\w)--(\w)/g, function(match, firstChar, lastChar) {
        return firstChar + ' -- ' + lastChar
      })
    },

    calloutHtml: function() {
        if (this.callout) {
            return this.callout.tableTags()
        }
    },

    formatHtml: function() {
        return this.calloutHtml() + this.addHTML()
    },

    formatText: function() {
        return this.miscFormatting()
    }
}
