var Url = function(options) {
  this.init(options)
}

Url.prototype = {

    init: function(options) {
        options = this.cleanText(options)
        this.base = options.base
        this.setClient(options.client)
        this.platform = options.platform
        this.setMedium(options.medium)
        this.date = options.date
        this.campaign = options.campaign
        this.additional = options.additional
        this.adProperties = options.adProperties
        this.addthisProperties = options.addthisProperties
    },

    cleanableText: function(input) {
        return !input.hasOwnProperty('title') && !input.hasOwnProperty('description') 
    },

    cleanText: function(options) {
        if ((typeof(options) == "object") && this.cleanableText(options))  {
            for (var i in options) {
                if (options.hasOwnProperty(i)) {
                    options[i] = this.cleanText(options[i])
                }
            }
        } else if (typeof(options) === 'string') {
            options = options.replace(' ', '-')
        }
        return options
    },
    
    setClient: function(client) {
        this.client = client
    },
 
    setMedium: function(medium) {
        this.medium = medium
    },

    formattedMedium: function(type) {
        if (type === 'url') {
            return this.medium + '_' 
        } else if (type === 'plain') {
            return this.medium
        }
    },
    
    getMedium:function() {
        return this.medium
    },
   
    getClient: function() {
        return clients[this.client]
    },

    fullUrl: function() {
       var urlArray = []
       urlArray.push(this.base)
       urlArray.push(this.operator())
       urlArray.push(this.params())
       return urlArray.join('')
    },

    operator: function() {
        var shortlinks = new RegExp('\\?'),
        operator = shortlinks.test(this.base) ? '&' : '?'
        return operator
    },

    params: function() { 
        var baseParams = [ 'track','tag','utm_source','source','sc','ms','refcode'],
            fullParams= []
         
         fullParams.push(this.constructBaseParams(baseParams))
         fullParams.push(this.googleAnalyticsParams())
         return fullParams.join('&')
    },

    googleAnalyticsParams: function() {
        return 'utm_campaign=' + this.campaign + '&utm_medium=' + this.formattedMedium('plain')
    },
 
    constructBaseParams: function(baseParams) {
        var baseParamsArray = []
        for (var i = 0; i < baseParams.length; i++) {
            var param = baseParams[i] + '=' + this.sourceCode()
            baseParamsArray.push(param)
        }
        return baseParamsArray.join('&')
    },

    sourceCode: function() {
        if (this.medium === 'ad') {
            return this.adSourceCode()
        } else {
            return this.standardSourceCode()
        }
    },

    standardSourceCode: function() {
        var array = [this.medium, this.date, this.campaign, this.additional, this.salsaBlastKey()]
        array = array.filter(function(e){return e})
        return array.join('_')
    },
    
    adSourceCode: function() {
        var array = [this.medium, this.adProperties.network, this.date, this.campaign, this.adProperties.geoTargeting, this.adProperties.flight, this.adProperties.variation, this.additional]
        return array.join('_')
    },

    salsaBlastKey: function() {
        if (this.platform === 'salsa' && this.medium === 'ema') {
            return 'bk[[email_blast_KEY]]' 
        }
    },
   
    addthisSuffix: function() {
        if (this.getMedium() === 'addthis') {
            return '_{{code}}'
         }
    }
}
