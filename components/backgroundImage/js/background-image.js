var BackgroundImageDispatcher = new Hask.Dispatcher();
var BackgroundImageConstants = {
    // Defining actions here
};

BackgroundImageDispatcher.register(function(payload) {
    switch(payload.actionType) {
        // Handle actions here
        default: break;
    }
});

$(document).ready(function() {
    // Dispatching actions here
});
