var AddthisCode = function(url) {
    this.init(url)
}

AddthisCode.prototype = {

    init: function (url) {
        this.url = url
        this.url.setMedium('addthis')
    },

    fullCode: function () {
        var codeArray = []
        codeArray.push('<script type="text/javascript">')
        codeArray.push('var addthis_config = {data_ga_property: "')
        codeArray.push(this.url.getClient().googleAnalyticsId)
        codeArray.push('",data_ga_social : true,data_track_clickback: true};var addthis_share = { url: "')
        codeArray.push(this.url.base)
        codeArray.push('", title: "')
        codeArray.push(this.url.addthisProperties.title)
        codeArray.push('",description: "')
        codeArray.push(this.url.addthisProperties.description)
        codeArray.push('", templates: {twitter:')
        codeArray.push(this.twitterText())
        codeArray.push('},')
        codeArray.push('url_transforms: { add: {')
        codeArray.push(this.urlTransforms())
        codeArray.push('}}};</script>')
        return codeArray.join('')
    },

    twitterText: function() {
        if (this.url.getClient().twitter) {
            return '"RT @' + this.url.getClient().twitter + ' {{title}}: {{url}}"'
        } else {
            return 
        }
    },

    constructUrlTransforms: function (baseTransforms) {
        var fullTransforms = []
        for (var i = 0; i < baseTransforms.length; i++) {
            fullTransforms.push(baseTransforms[i])
            fullTransforms.push(': "')
            fullTransforms.push(this.url.sourceCode())
            fullTransforms.push('",')
        }
        fullTransforms.push(this.googleAnalyticsTransforms())
        return fullTransforms.join('')
    },

    googleAnalyticsTransforms: function() {
        return 'utm_medium: "' + this.url.formattedMedium('plain') + '", utm_campaign: "' + this.url.campaign + '"'
    },

    urlTransforms: function () {
        var baseTransforms = ['track', 'tag', 'utm_source', 'source', 'sc', 'ms', 'refcode']
        return this.constructUrlTransforms(baseTransforms)
    }
}
