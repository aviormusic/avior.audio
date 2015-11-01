var SectionDispatcher = new Hask.Dispatcher();
var SectionConstants = {
    // Defining actions here
};

SectionDispatcher.register(function(payload) {
    switch(payload.actionType) {
        // Handle actions here
        default: break;
    }
});

$(document).ready(function() {
    // Dispatching actions here
});
