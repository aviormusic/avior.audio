var TimelineDispatcher = new Hask.Dispatcher();
var TimelineConstants = {
    // Defining actions here
};

TimelineDispatcher.register(function(payload) {
    switch(payload.actionType) {
        // Handle actions here
        default: break;
    }
});

$(document).ready(function() {
    // Dispatching actions here
}); 
