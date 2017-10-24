function breakoutOfFrame()
{
    // see https://www.thesitewizard.com/archive/framebreak.shtml
    // for an explanation of this script and how to use it on your
    // own website
    if (top.location != location) {
        top.location.href = document.location.href ;
    } else {
        document.body.className += ' ' + 'home';
    }
}

breakoutOfFrame();