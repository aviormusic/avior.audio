var NavigationDispatcher = new Hask.Dispatcher();
var NavigationConstants = {
    // Defining actions here
};

NavigationDispatcher.register(function(payload) {
    switch(payload.actionType) {
        // Handle actions here
        default: break;
    }
});

// Caching document
var $document = $(document);

$document.ready(function() {
    var $swapSection = $('section:nth-child(2)');
    $document.scroll(function(ev) {
        if($document.scrollTop() === $swapSection.offset().top) {
            $('.component-navigation').addClass('swap');
        }
    })
    console.log();
});
