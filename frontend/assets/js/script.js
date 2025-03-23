$(document).ready(function() {

    $("main#spapp > section").height($(document).height() - 60);

    var app = $.spapp({ pageNotFound: 'view_404' }); 


    var app = $.spapp({
        defaultView : "#hero",
        templateDir : "./views"
    })


    app.route({
        view: 'about',
        load: 'about.html' // Loads about.html dynamically
    });

    // Run the app
    app.run();
});
