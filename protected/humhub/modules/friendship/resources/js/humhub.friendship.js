
humhub.module('friendship', function (module, require, $) {
    var client = require('client');
    var additions = require('ui.additions');
    var Component = require('action').Component;

    var toggleFriendship= function (evt) {

        client.post(evt).then(function (response) {
            if(response.currentUserFriended) {
                additions.switchButtons(evt.$trigger, evt.$trigger.siblings('.unfriendship'));
                var component = Component.closest(evt.$trigger);
                if(component) {
                    component.$.trigger('humhub:friendship:friented');
                }
            } else {
                additions.switchButtons(evt.$trigger, evt.$trigger.siblings('.friendship'));
            }

        }).catch(function (err) {
            module.log.error(err, true);
        });
    };


    module.export({
        toggleFriendship: toggleFriendship
    });
});