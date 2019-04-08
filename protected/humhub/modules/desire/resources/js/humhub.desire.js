humhub.module('desire', function(module, require, $) {
    var Widget = require('ui.widget').Widget;
    var object = require('util').object;

    var Desire = function(node, options) {
        Widget.call(this, node, options);
    };

    object.inherits(Desire, Widget);

    module.export({
        Desire: Desire
    });

});