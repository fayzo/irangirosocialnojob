function togglePopup ( ) {
    // let disabler = document.getElementById('disabler');
    // disabler.style.display = disabler.style.display ? '' : 'none';

    // let popup = document.getElementById('popupEnd');
    // popup.style.display = popup.style.display ? '' : 'none';

    var disabler = document.getElementById('disabler');
        if (disabler.style.display) {
        disabler.style.display = '';
        } else {
        disabler.style.display = 'none';
        }

    var popup = document.getElementById('popupEnd');
        if (popup.style.display) {
        popup.style.display = '';
        } else {
        popup.style.display = 'none';
        }
}