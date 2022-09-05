define(
    [
        'ko',
        'uiComponent'
    ],
    function (ko, UiComponent)
    {
        "use strict";
        return UiComponent.extend({
            defaults:
                {
                    template: 'Checkout_Page/checkout-form'
                },
            isRegisterNewsletter: true
        });
    }
);
