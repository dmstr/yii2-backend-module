
window.addEventListener("load", function () {
  if (sessionStorage.outdated_browser_confirmed  === "1") {
    document.getElementById("outdated").remove();
  } else {
    document.getElementById("buttonCloseUpdateBrowser").addEventListener("mousedown", function (e) {
      e.preventDefault();
      sessionStorage.outdated_browser_confirmed = "1";
    });
  }
});

