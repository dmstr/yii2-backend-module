function toggleSidebar() {
    $("#sidebar-wrapper").toggleClass("active");
}

$(document).ready(function () {

    var initialRequest = true;
    $('#sidebar-wrapper iframe').on('load', function () {
        console.log('iframe load');
        if (!initialRequest) {
            $('#sidebar-wrapper').addClass('active');
            $('#sidebar-wrapper').addClass('show-iframe');
        }
        initialRequest = false;
    });

    $('.hide-iframe')
        .on('mouseover', function () {
            $('#sidebar-wrapper').addClass('hide-iframe');
        })
        .on('mouseout', function () {
            $('#sidebar-wrapper').removeClass('hide-iframe');
            $('#sidebar-wrapper').removeClass('show-iframe');
        })

    console.log('Done');
});
