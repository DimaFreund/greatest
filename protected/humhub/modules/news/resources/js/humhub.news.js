humhub.module('news', function(module, require, $) {
    var Widget = require('ui.widget').Widget;
    var object = require('util').object;

    var News = function(node, options) {
        Widget.call(this, node, options);
    };

    object.inherits(News, Widget);

    module.export({
        News: News
    });

});