// Initialize Variables
var closePopup = document.getElementById("popupclose");
var overlay = document.getElementById("overlay");
var popup = document.getElementById("popup");


// Close Popup Event
closePopup.onclick = function() {
    overlay.style.display = 'none';
    popup.style.display = 'none';
};

function globalOnLoad() {
    // Assign link events
    for (var i = 0; i < document.links.length; i++) {
        if (document.links[i].className.match('popup')) {

            var href = $('a[href*="wp-content/uploads/"]').attr('href');
            $("#popup-image").attr('src', href);

            document.links[i].onclick = function() {
                overlay.style.display = 'flex';
                popup.style.display = 'block';

                return false;

            };


        }
    }
    // Run page onLoad function, if it exists
    if (typeof onLoad != 'undefined') {
        onLoad();


    }
}

// Every page should execute the global onload function
window.onload = globalOnLoad;
