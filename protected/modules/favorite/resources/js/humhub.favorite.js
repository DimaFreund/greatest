humhub.module('favorite', function (module, require, $) {
    var client = require('client');
    var additions = require('ui.additions');
    var Component = require('action').Component;

    var toggleFavorite = function (evt) {

        client.post(evt).then(function (response) {
            if(response.currentUserFavorited) {
                additions.switchButtons(evt.$trigger, evt.$trigger.siblings('.unfavorite'));
                var component = Component.closest(evt.$trigger);
                if(component) {
                    component.$.trigger('humhub:favorite:favorited');
                }
            } else {
                additions.switchButtons(evt.$trigger, evt.$trigger.siblings('.favorite'));
            }

            // _updateCounter(evt.$trigger.parent(), response.favoriteCounter);
        }).catch(function (err) {
            module.log.error(err, true);
        });
    };

    var _updateCounter = function($element, count) {
        if (count) {
            $element.find(".favoriteCount").html('(' + count + ')').show();
        } else {
            $element.find(".favoriteCount").hide();
        }

    };

    module.export({
        toggleFavorite: toggleFavorite
    });
});