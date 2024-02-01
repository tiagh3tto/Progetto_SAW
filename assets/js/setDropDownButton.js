$(document).ready(function(){
    $(".dropdown-menu input[type='radio']").click(function(){
        var selected = $(this).val();
        $("#dropdownMenuButton").html('<i class="fas fa-filter"></i> ' + selected);
    });

    // Trigger a click event on the checked radio button when the page loads
    $(".dropdown-menu input[type='radio']:checked").click();
});