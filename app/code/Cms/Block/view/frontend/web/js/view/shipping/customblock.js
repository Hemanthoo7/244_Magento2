define(
    [
        'uiComponent',
        'jquery',
        'ko'
    ],
    function(
        Component,
        $,
        ko
    ) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Cms_Block/shipping/cms-block'
            },

            initialize: function () {
                var self = this;
                this._super();
            }

        });
    }
);
