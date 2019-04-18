
window.addEventListener("load", function () {
  var outdatedBrowserButton = document.getElementById("buttonCloseUpdateBrowser");
  if (sessionStorage.outdated_browser_confirmed  === "1") {
    document.getElementById("outdated").remove();
  } else {
    if (outdatedBrowserButton !== null) {
      outdatedBrowserButton.addEventListener("mousedown", function (e) {
        e.preventDefault();
        sessionStorage.outdated_browser_confirmed = "1";
      });
    }
  }
});

