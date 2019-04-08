humhub.module('blog', function(module, require, $) {
    var Widget = require('ui.widget').Widget;
    var object = require('util').object;

    var Blog = function(node, options) {
        Widget.call(this, node, options);
    };

    object.inherits(Blog, Widget);

    module.export({
        Blog: Blog
    });

});