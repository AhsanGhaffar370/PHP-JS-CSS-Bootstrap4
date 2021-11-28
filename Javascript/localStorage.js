(function($) {
    $(document).ready(function() {
        $(document).on("click", '.sw_services', function(e) {
            e.preventDefault();
            let service_val = $(this).closest('.sw_services_col').find('h6.elementor-heading-title').length ? $(this).closest('.sw_services_col').find('h6.elementor-heading-title').text() : '';
            let cart = JSON.parse(getStorage("cart")) || [];

            if ($.inArray(service_val, cart) === -1) {
                cart.push(service_val);
                setStorage("cart", JSON.stringify(cart), 60 * 60);
            }
        });

        let com_url_locat = window.location.href;
        if (com_url_locat.includes("online-booking")) {
            let total_cart = JSON.parse(getStorage("cart")) || [];
            total_cart.forEach(element => {
                $('#wpforms-form-1585 input[name="wpforms[fields][7][]"][value="' + element.trim().toUpperCase() + '"]').length ? $('#wpforms-form-1585 input[name="wpforms[fields][7][]"][value="' + element.trim().toUpperCase() + '"]').prop('checked', true) : '';
            });
        }
    });
})(jQuery);


function setStorage(key, value, expires) {
    if (expires === undefined || expires === null) {
        expires = (24 * 60 * 60); // default: seconds for 1 day
    } else {
        expires = Math.abs(expires); //make sure it's positive
    }

    var now = Date.now(); //millisecs since epoch time, lets deal only with integer
    var schedule = now + expires * 1000;
    try {
        localStorage.setItem(key, value);
        localStorage.setItem(key + '_expiresIn', schedule);
    } catch (e) {
        console.log('setStorage: Error setting key [' + key + '] in localStorage: ' + JSON.stringify(e));
        return false;
    }
    return true;
}

function getStorage(key) {
    var now = Date.now(); //epoch time, lets deal only with integer
    // set expiration for storage
    var expiresIn = localStorage.getItem(key + '_expiresIn');
    if (expiresIn === undefined || expiresIn === null) { expiresIn = 0; }

    if (expiresIn < now) { // Expired
        removeStorage(key);
        return null;
    } else {
        try {
            var value = localStorage.getItem(key);
            return value;
        } catch (e) {
            console.log('getStorage: Error reading key [' + key + '] from localStorage: ' + JSON.stringify(e));
            return null;
        }
    }
}

function removeStorage(name) {
    try {
        localStorage.removeItem(name);
        localStorage.removeItem(name + '_expiresIn');
    } catch (e) {
        console.log('removeStorage: Error removing key [' + key + '] from localStorage: ' + JSON.stringify(e));
        return false;
    }
    return true;
}