humhub.module('share', function (module, require, $) {
    var client = require('client');
    var additions = require('ui.additions');
    var Component = require('action').Component;

    var toggleShare = function (evt) {

        client.post(evt).then(function (response) {
            // if(response.currentUserShared) {
            //     additions.switchButtons(evt.$trigger, evt.$trigger.siblings('.unshare'));
            //     var component = Component.closest(evt.$trigger);
            //     if(component) {
            //         component.$.trigger('humhub:share:shared');
            //     }
            // } else {
            //     additions.switchButtons(evt.$trigger, evt.$trigger.siblings('.share'));
            // }
            evt.$trigger.find('.text').html('Shared');
            _updateCounter(evt.$trigger.parent(), response.shareCounter);
        }).catch(function (err) {
            module.log.error(err, true);
        });
    };

    var _updateCounter = function($element, count) {
        if (count) {
            $element.find(".shareCount").html('(' + count + ')').show();
        } else {
            $element.find(".shareCount").hide();
        }

    };

    module.export({
        toggleShare: toggleShare
    });
});