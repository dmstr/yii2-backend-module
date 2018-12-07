// assign keyboard-action for modal and view mode
// - only when focus is on <body>, to avoid unwanted keyboard actions

$(document).on("keypress", function (e) {
    if ($(document.activeElement).is('body')) {
// open menu (m)
        if (e.charCode === 109) {
            $('#phd-info-button a').click()
        }
// toggle view-mode (v)
        if (e.charCode === 118) {
            $('#app-frontend-view-mode-button').click()
        }
// toggle button (h)
        if (e.charCode === 104) {
            $('#phd-info-button').toggle()
        }
    }
})