/*$(function() {
    var danger = $("span .alert-danger");
    danger.removeClass("alert-danger").addClass("alert-success");
    console.info("tag", danger);
});*/

$(function() {
    $("#first").addClass("active");
    $(".recherche").click(function() {
        $("#search-form")[0]
            .classList.toggle("d-none")
            .toggle("show-search");
        alert($("#search-form")[0].classList);
    });
});
