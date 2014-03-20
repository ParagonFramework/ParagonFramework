pimcore.registerNS("pimcore.plugin.paragonframework");

pimcore.plugin.paragonframework = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.paragonframework";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },
 
    pimcoreReady: function (params,broker){
        // alert("Example Ready!");
    }
});

var paragonframeworkPlugin = new pimcore.plugin.paragonframework();

