//on doc load
$(document).ready(function() {
    //json ajax request 
    $.ajax({
        type: "GET",
        url: "lab8.json",
        dataType: "json",
        success: function (data) {
            var output = "";

            $.each(data.labs, function(index, project){

                output += '<div class="lab-display">';
                output += '<img class="lab-img" src="' + project.image + '" alt="' + project.alt + '">';
                output += '<div class="lab-text">';
                output += '<a class="lab-title" href="' + project.link + '">' + project.title + '</a>';
                output += '<p class="lab-info">' + project.description + '</p>';
                output += '</div>';
                output += '</div>';
            });

            $("#projectList").html(output);

            $(".lab-display").hide().each(function (index){
                $(this).delay(index * 250).fadeIn(800);
            });
        },
        error: function () {
            $("#projectList").html("<p>Sorry, the lab list could not be loaded.</p>");
        }
    });

    $("#toggleLabs").click(function() {
        $(".lab-display").slideToggle(500);

        if($(this).text() == "Hide All Labs") {
            $(this).text("Show All Labs");
        } else {
            $(this).text("Hide All Labs");
        }
    });

    $("#backToTop").hide();
    $(window).scroll(function () {
        if($(this).scrollTop() > 200) {
            $("#backToTop").fadeIn(400);
        } else {
            $("#backToTop").fadeOut(400);
        }
    });

    $("#backToTop").click(function() {
        $("html, body").animate({scrollTop: 0}, 600);
    });
});