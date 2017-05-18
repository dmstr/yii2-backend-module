function toggleSidebar() {
    $("#sidebar-wrapper").toggleClass("active");
}

$(document).ready(function () {

    var initialRequest = true;
    $('#sidebar-wrapper iframe').on('load', function () {
        console.log('iframe load');
        if (!initialRequest) {
            $('#sidebar-wrapper').addClass('active');
        }
        initialRequest = false;
    });

    $('.hide-iframe')
        .on('mouseover', function () {
            $('#sidebar-wrapper iframe').hide();
        })
        .on('mouseout', function () {
            $('#sidebar-wrapper iframe').show();
        })

    console.log('Done');
});
