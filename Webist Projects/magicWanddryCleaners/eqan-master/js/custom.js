jQuery(document).ready(function() {

    console.log(im_script_vars.siteUrl + ' - ' + im_script_vars.siteName);
    var orderItemVar = im_script_vars.siteName + '-order-items';

    // Check items in carts
    if (localStorage.getItem(orderItemVar) === "" || localStorage.getItem(orderItemVar) === null || localStorage.getItem(orderItemVar) === undefined) {
        userOrder = {};
    } else {
        var userOrder = JSON.parse(localStorage.getItem(orderItemVar));
        Object.keys(userOrder).forEach(function(key) {
            var rowTotal = userOrder[key].price * userOrder[key].qty;
            jQuery('.service-quantity-' + key).val(userOrder[key].qty);
            var newRow = '<div class="col-xs-12 new-row"><div class="new-append-row"><div class="row"><div class="col-xs-4 col-sm-3 col-md-4 left-box"><span data-remove-id="' + key + '" class="remove-btn"></span><span>' + userOrder[key].title + '</span><input type="hidden" class="service-title" name="title[]" value="' + userOrder[key].title + '"></div>' +
                '<div class="col-xs-5 col-sm-4 col-md-4 middel-box">' +
                '<div class="row">' +
                '<div class="col-xs-7 col-sm-4 col-md-6 left-box less-middel-on-mobile"><input type="number" class="service-qty number-stepper qty-' + key + '" min="1" name="qty[]" value="' + userOrder[key].qty + '" autocomplete="off"></div>' +
                '<div class="col-xs-5 col-sm-4 col-md-6 right-box"><span class="price-' + key + '">&pound;' + userOrder[key].price + '</span><input type="hidden" class="service-price price-' + key + '" name="price[]" value="' + userOrder[key].price + '"><input type="hidden" class="row-id" name="id[]" value="' + key + '"></div>' +
                '</div>' +
                '</div>' +
                '<div class="col-xs-3 col-sm-3 col-md-4 right-box">' +
                '<div class="row">' +
                '<div class="col-xs-12 col-sm-12 col-md-12 left-box"><span class="row-total total-' + key + '">&pound;' + rowTotal.toFixed(2) + '</span><input type="hidden" class="row-total dead-total total-' + key + '" name="total[]" value="' + rowTotal.toFixed(2) + '"></div>' +
                '</div>' +
                '</div></div></div></div>';
            jQuery('.repeatable-box').append(newRow);
            // Number js
            jQuery('.qty-' + key).each(function() {
                jQuery(this).number();
            });
        });
        getGrandTotal();
    }

    // add order to cart
    jQuery('.order-button-holder button').on('click', function() {
        var error_count = 0;
        jQuery('.multi-list li').each(function() {
            var qty = jQuery(this).find('input').val();
            if (qty > 0 && qty != '') {
                var id = jQuery(this).data('id');
                var price = jQuery(this).data('price');
                var title = jQuery(this).data('title');
                userOrder[id] = {
                    price: price,
                    title: title,
                    qty: qty
                }
                error_count++;
            }
        });
        if (error_count > 0) {
            var orderItems = JSON.stringify(userOrder);
            //console.log(orderItems);
            localStorage.setItem(orderItemVar, orderItems);
            window.location.href = im_script_vars.siteUrl + '/booking/';
        } else {
            alert('No item selected');
        }
    });

    // Jquery select
    //jQuery('.eqan_service').selectpicker('refresh');
    jQuery('body').on('change', '.eqan_service', function() {
        var currentPrice = jQuery(this).find(":selected").data("price");
        var currentId = jQuery(this).find(":selected").data("id");
        if (typeof currentPrice !== "undefined") {
            jQuery(this).parent().parent().find('.service-current-qty').val(1);
            jQuery(this).parent().parent().find('.service-price').val(currentPrice);
            jQuery(this).parent().parent().find('.row-total').val(currentPrice);
            jQuery(this).parent().parent().find('.row-id').val(currentId);
        }
    });
    // Add row
    jQuery('body').on('click', '.add-btn', function(e) {
        e.preventDefault();
        var currentService = jQuery(this).parent().parent().parent().parent().find('.eqan_service').val();
        if (currentService == '') {
            alert('Please select an item');
            return false;
        } else {
            var currentService = jQuery(this).parent().parent().parent().parent().find('.eqan_service').val();
            var currentQty = jQuery(this).parent().parent().parent().parent().find('.service-current-qty').val();
            var currentPrice = jQuery(this).parent().parent().parent().parent().find('.service-price').val();
            var currentTotal = jQuery(this).parent().parent().parent().parent().find('.row-total').val();
            var id = jQuery(this).parent().parent().parent().parent().find('.row-id').val();
            //console.log(currentService+' '+currentQty+' '+currentPrice+' '+currentTotal);
            if (id in userOrder) {
                var qty = userOrder[id]['qty'];
                qty = parseInt(qty) + parseInt(currentQty);
                userOrder[id] = {
                    price: currentPrice,
                    title: currentService,
                    qty: qty
                }

                jQuery('.qty-' + id).val(qty);
                jQuery('.price-' + id).val(currentPrice);
                jQuery('.price-' + id).text(currentPrice);
                var rowTotal = currentPrice * qty;
                jQuery('.total-' + id).val(rowTotal);
                jQuery('.total-' + id).text(rowTotal);

            } else {
                userOrder[id] = {
                    price: currentPrice,
                    title: currentService,
                    qty: currentQty
                }

                var newRow = '<div class="col-xs-12 new-row"><div class="new-append-row"><div class="row"><div class="col-xs-4 col-sm-3 col-md-4 left-box"><span data-remove-id="' + id + '" class="remove-btn"></span><span>' + currentService + '</span><input type="hidden" class="service-title" name="title[]" value="' + currentService + '"></div>' +
                    '<div class="col-xs-5 col-sm-4 col-md-4 middel-box">' +
                    '<div class="row">' +
                    '<div class="col-xs-7 col-sm-4 col-md-6 left-box less-middel-on-mobile"><input type="number" class="service-qty qty-' + id + '" min="1" name="qty[]" value="' + currentQty + '" autocomplete="off"></div>' +
                    '<div class="col-xs-5 col-sm-4 col-md-6 right-box"><span class="price-' + id + '">&pound;' + currentPrice + '</span><input type="hidden" class="service-price price-' + id + '" name="price[]" value="' + currentPrice + '"><input type="hidden" class="row-id" name="id[]" value="' + id + '"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-xs-3 col-sm-3 col-md-4 right-box">' +
                    '<div class="row">' +
                    '<div class="col-xs-12 col-sm-12 col-md-12 left-box"><span class="row-total total-' + id + '">&pound;' + currentTotal + '</span><input type="hidden" class="row-total dead-total total-' + id + '" name="total[]" value="' + currentTotal + '"></div>' +
                    '</div>' +
                    '</div></div></div></div>';
                jQuery('.repeatable-box').append(newRow);
                jQuery('.qty-' + id).each(function() {
                    jQuery(this).number();
                });

            }
            var orderItems = JSON.stringify(userOrder);
            //console.log(orderItems);
            localStorage.setItem(orderItemVar, orderItems);
            jQuery('.eqan_service').selectpicker('val', '');
            jQuery(this).parent().parent().parent().parent().find('input').val('');
            getGrandTotal();
        }
    });

    // Remove row
    jQuery('body').on('click', '.remove-btn', function(e) {
        e.preventDefault();
        var removeId = jQuery(this).data('remove-id');
        var userOrder = JSON.parse(localStorage.getItem(orderItemVar));
        //userOrder = userOrder.splice(removeId, 1);
        delete userOrder[removeId];
        var orderItems = JSON.stringify(userOrder);
        localStorage.setItem(orderItemVar, orderItems);
        //console.log(userOrder);
        jQuery(this).parent().parent().parent().parent().remove();
        getGrandTotal();
    });

    // Qty change function on exist row
    jQuery('body').on('keyup change', '.service-current-qty', function() {
        var currentService = jQuery(this).parent().parent().parent().parent().find('.eqan_service').val();
        if (typeof currentService === "undefined" || currentService == '') {
            alert('Please select an item');
            jQuery(this).val('');
            return false;
        } else {
            var currentQty = jQuery(this).val();
            var currentPrice = jQuery(this).parent().parent().parent().find('.service-price').val();
            var rowTotal = currentQty * currentPrice;
            rowTotal = rowTotal.toFixed(2);
            jQuery(this).parent().parent().parent().parent().find('.row-total').val(rowTotal);
            //getGrandTotal();
        }
    });

    // Qty change function on appended row
    jQuery('body').on('keyup change', '.service-qty', function() {
        var currentQty = jQuery(this).val();
        var currentService = jQuery(this).parent().parent().parent().parent().parent().parent().find('.service-title').val();
        console.log(currentService);
        var currentPrice = jQuery(this).parent().parent().parent().parent().find('.service-price').val();
        var id = jQuery(this).parent().parent().parent().parent().find('.row-id').val();
        var rowTotal = currentQty * currentPrice;
        rowTotal = rowTotal.toFixed(2);
        jQuery(this).parent().parent().parent().parent().parent().find('.row-total').html('&pound' + rowTotal);
        jQuery(this).parent().parent().parent().parent().parent().find('.row-total').val(rowTotal);
        if (id in userOrder) {
            userOrder[id] = {
                price: currentPrice,
                title: currentService,
                qty: currentQty
            };
            var orderItems = JSON.stringify(userOrder);
            //console.log(orderItems);
            localStorage.setItem(orderItemVar, orderItems);
        }
        getGrandTotal();
    });

    // Qty change function on appended row
    jQuery('body').on('click', '.number-plus, .number-minus', function() {
        var currentQty = jQuery(this).parent().find('.service-qty').val();
        var currentService = jQuery(this).parent().parent().parent().parent().parent().parent().find('.service-title').val();
        console.log(currentService);
        var currentPrice = jQuery(this).parent().parent().parent().parent().find('.service-price').val();
        var id = jQuery(this).parent().parent().parent().parent().find('.row-id').val();
        var rowTotal = currentQty * currentPrice;
        rowTotal = rowTotal.toFixed(2);
        jQuery(this).parent().parent().parent().parent().parent().find('.row-total').html('&pound' + rowTotal);
        jQuery(this).parent().parent().parent().parent().parent().find('.row-total').val(rowTotal);
        if (id in userOrder) {
            userOrder[id] = {
                price: currentPrice,
                title: currentService,
                qty: currentQty
            };
            var orderItems = JSON.stringify(userOrder);
            //console.log(orderItems);
            localStorage.setItem(orderItemVar, orderItems);
        }
        getGrandTotal();
    });

    // Get grand total
    function getGrandTotal() {
        var grandTotal = 0;
        var count = 0;
        jQuery('.new-row').each(function() {
            var thisFieldTotal = jQuery(this).find('.dead-total').val();
            grandTotal += parseFloat(thisFieldTotal);
        });
        if (!isNaN(grandTotal)) {
            if (grandTotal < 20 && grandTotal > 0) {
                jQuery('.shipping-note').show();
            } else {
                jQuery('.shipping-note').hide();
            }
            jQuery('.show-total').html('Grand Total: &pound;' + grandTotal.toFixed(2));
        }
    }

    // Booking form 
    jQuery('.field-price').on('change', function() {
        var fieldQty = Query(this).val();
        var fieldPrice = jQuery(this).data('price');
        var totalPrice = parseFloat(fieldPrice * fieldQty).toFixed(2);
        jQuery('.grand-total-div h3').remove();
        jQuery(this).parent().parent().find('span').text('Â£' + totalPrice);
        jQuery(this).parent().parent().find('span').attr('data-field-total', totalPrice);
        jQuery(this).parent().parent().find('.hidden-total-price').val(totalPrice);
        var grandTotal = 1;
        jQuery('.total-price').each(function() {
            var thisFieldTotal = jQuery(this).data('field-total');
            grandTotal += thisFieldTotal;
        });
        //alert(grandTotal);
        //jQuery('.grand-total-div').append('<h3>Â£'+parseFloat(grandTotal).toFixed(2)+'</h3>');
    });

    jQuery('.check-post-code').on('blur', function() {
        var postCode = jQuery(this).val();
        /*if(postCode != 'NW3' && postCode != 'NW6' && postCode != 'NW8' && postCode != 'W1' && postCode != 'NW11' && postCode != 'nw3' && postCode != 'nw6' && postCode != 'nw8' && postCode != 'w1' && postCode != 'nw11'){
          jQuery(this).val('');
        }*/
        if (postCode.startsWith('NW3') || postCode.startsWith('nw3') || postCode.startsWith('NW8') || postCode.startsWith('nw8') || postCode.startsWith('W1') || postCode.startsWith('w1') || postCode.startsWith('NW11') || postCode.startsWith('nw11')) {
            console.log('done');
        } else {
            jQuery(this).val('');
            jQuery(this).attr('placeholder', postCode);
        }
    });

    // Datepicker
    var todaydt = new Date();
    var currentHour = todaydt.getHours();

    // Check timeslot
    if (currentHour < 8) {
        var selectOption = '<option value="08:00 AM - 11:00 AM">08:00 AM - 11:00 AM</option>' +
            '<option value="11:00 AM - 03:00 PM">11:00 AM - 03:00 PM</option>' +
            '<option value="03:00 PM - 07:00 PM">03:00 PM - 07:00 PM</option>';
        jQuery('#ctime').empty();
        jQuery('#ctime').append(selectOption);
        var todaydt = new Date();
        todaydt.setDate(todaydt.getDate() - 1);
    } else if (currentHour < 11) {
        var selectOption = '<option value="11:00 AM - 03:00 PM">11:00 AM - 03:00 PM</option>' +
            '<option value="03:00 PM - 07:00 PM">03:00 PM - 07:00 PM</option>';
        jQuery('#ctime').empty();
        jQuery('#ctime').append(selectOption);
        var todaydt = new Date();
        todaydt.setDate(todaydt.getDate() - 1);
    } else if (currentHour < 15) {
        var selectOption = '<option value="03:00 PM - 07:00 PM">03:00 PM - 07:00 PM</option>';
        jQuery('#ctime').empty();
        jQuery('#ctime').append(selectOption);
        var todaydt = new Date();
        todaydt.setDate(todaydt.getDate() - 1);
    } else if (currentHour >= 15) {
        var todaydt = new Date();
        var selectOption = '<option value="08:00 AM - 11:00 AM">08:00 AM - 11:00 AM</option>' +
            '<option value="11:00 AM - 03:00 PM">11:00 AM - 03:00 PM</option>' +
            '<option value="03:00 PM - 07:00 PM">03:00 PM - 07:00 PM</option>';
        jQuery('#ctime').empty();
        jQuery('#ctime').append(selectOption);
    }

    var dates1 = ["20/05/2021", "21/05/2021", "22/05/2021"];

    function DisableDates1(date1) {
        var string = jQuery.datepicker.formatDate('dd/mm/yy', date1);
        return [dates1.indexOf(string) == -1];
    }

    jQuery("#datepicker1").datepicker({
        minDate: 2,
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        numberOfMonths: 1,
        changeYear: true,

        beforeShowDay: DisableDates1,

        onClose: function(selectedDate, inst) {
            var minDate = new Date(Date.parse(selectedDate));
            minDate.setDate(minDate.getDate() + 2);
            jQuery("#datepicker2").datepicker("option", "minDate", minDate);
        }
    });

    jQuery("#datepicker2").datepicker({
        minDate: "+1D",
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        numberOfMonths: 1,
        changeYear: true,

        beforeShowDay: DisableDates1,

        onClose: function(selectedDate, inst) {
            var maxDate = new Date(Date.parse(selectedDate));
            maxDate.setDate(maxDate.getDate() - 1);
            jQuery("#datepicker1").datepicker("option", "maxDate", maxDate);
        }
    });

    // Timepicker
    jQuery('.timepicker').timepicker();

    jQuery('#myModal1,#myModal2,#myModal3,#myModal4').on('click', function() {
        jQuery(this).removeClass('show');
    });

    if (jQuery('body').hasClass('inner')) {
        jQuery('li').removeClass('scroll');
    }

    // Check li has ul
    jQuery('.new-inner-page li:has(ul)').addClass('parent-list');

    // Top 4 boxes
    setTimeout(function() {
        jQuery('.feature-1,.single_post-1,.section_two_post-1').removeClass('active');
        jQuery('.feature-2,.single_post-2,.section_two_post-2').addClass('active');
    }, 2000);

    setTimeout(function() {
        jQuery('.feature-2,.single_post-2,.section_two_post-2').removeClass('active');
        jQuery('.feature-3,.single_post-3,.section_two_post-3').addClass('active');
    }, 4000);

    setTimeout(function() {
        jQuery('.feature-3,.single_post-3,.section_two_post-3').removeClass('active');
        jQuery('.feature-4,.single_post-4,.section_two_post-4').addClass('active');
    }, 6000);

    setTimeout(function() {
        jQuery('.feature-4,.single_post-4,.section_two_post-4').removeClass('active');
        jQuery('.feature-1,.single_post-1,.section_two_post-1').addClass('active');
    }, 8000);

    setInterval(function() {
        setTimeout(function() {
            jQuery('.feature-1,.single_post-1,.box-new-1,.section_two_post-1').removeClass('active');
            jQuery('.feature-2,.single_post-2,.box-new-2,.section_two_post-2').addClass('active');
        }, 2000);

        setTimeout(function() {
            jQuery('.feature-2,.single_post-2,.box-new-2,.section_two_post-2').removeClass('active');
            jQuery('.feature-3,.single_post-3,.box-new-3,.section_two_post-3').addClass('active');
        }, 4000);

        setTimeout(function() {
            jQuery('.feature-3,.single_post-3,.box-new-3,.section_two_post-3').removeClass('active');
            jQuery('.feature-4,.single_post-4,.box-new-4,.section_two_post-4').addClass('active');
        }, 6000);

        setTimeout(function() {
            jQuery('.feature-4,.single_post-4,.box-new-4,.section_two_post-4').removeClass('active');
            jQuery('.feature-1,.single_post-1,.box-new-1,.section_two_post-1').addClass('active');
        }, 8000);
    }, 8000);

    // Middel 3 Boxes
    setTimeout(function() {
        jQuery('.in-box-1,.section_one_post-1').removeClass('active');
        jQuery('.in-box-2,.section_one_post-2').addClass('active');
    }, 3000);

    setTimeout(function() {
        jQuery('.in-box-2,.section_one_post-2').removeClass('active');
        jQuery('.in-box-3,.section_one_post-3').addClass('active');
    }, 6000);

    setTimeout(function() {
        jQuery('.in-box-3,.section_one_post-3').removeClass('active');
        jQuery('.in-box-1,.section_one_post-1').addClass('active');
    }, 9000);

    setInterval(function() {
        setTimeout(function() {
            jQuery('.in-box-1,.section_one_post-1').removeClass('active');
            jQuery('.in-box-2,.section_one_post-2').addClass('active');
        }, 3000);

        setTimeout(function() {
            jQuery('.in-box-2,.section_one_post-2').removeClass('active');
            jQuery('.in-box-3,.section_one_post-3').addClass('active');
        }, 6000);

        setTimeout(function() {
            jQuery('.in-box-3,.section_one_post-3').removeClass('active');
            jQuery('.in-box-1,.section_one_post-1').addClass('active');
        }, 9000);
    }, 9000);


    // 6 boxes
    setTimeout(function() {
        jQuery('.service-1,.general-box-1').removeClass('active');
        jQuery('.service-2,.general-box-2').addClass('active');
    }, 2000);

    setTimeout(function() {
        jQuery('.service-2,.general-box-2').removeClass('active');
        jQuery('.service-3,.general-box-3').addClass('active');
    }, 4000);

    setTimeout(function() {
        jQuery('.service-3,.general-box-3').removeClass('active');
        jQuery('.service-4,.general-box-4').addClass('active');
    }, 6000);

    setTimeout(function() {
        jQuery('.service-4,.general-box-4').removeClass('active');
        jQuery('.service-5,.general-box-5').addClass('active');
    }, 8000);

    setTimeout(function() {
        jQuery('.service-5,.general-box-5').removeClass('active');
        jQuery('.service-6,.general-box-6').addClass('active');
    }, 10000);

    setTimeout(function() {
        jQuery('.service-6,.general-box-6').removeClass('active');
        jQuery('.service-1,.general-box-1').addClass('active');
    }, 12000);

    setInterval(function() {
        setTimeout(function() {
            jQuery('.service-1,.general-box-1').removeClass('active');
            jQuery('.service-2,.general-box-2').addClass('active');
        }, 2000);

        setTimeout(function() {
            jQuery('.service-2,.general-box-2').removeClass('active');
            jQuery('.service-3,.general-box-3').addClass('active');
        }, 4000);

        setTimeout(function() {
            jQuery('.service-3,.general-box-3').removeClass('active');
            jQuery('.service-4,.general-box-4').addClass('active');
        }, 6000);

        setTimeout(function() {
            jQuery('.service-4,.general-box-4').removeClass('active');
            jQuery('.service-5,.general-box-5').addClass('active');
        }, 8000);

        setTimeout(function() {
            jQuery('.service-5,.general-box-5').removeClass('active');
            jQuery('.service-6,.general-box-6').addClass('active');
        }, 10000);

        setTimeout(function() {
            jQuery('.service-6,.general-box-6').removeClass('active');
            jQuery('.service-1,.general-box-1').addClass('active');
        }, 12000);
    }, 12000);

    jQuery('#myModal1,#myModal2').on('click', function() {
        jQuery(this).removeClass('show');
    });

    // Owl Carousel
    jQuery('#pink-slider').owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        autoplay: true,
        dots: false,
        nav: false,
        autoplayTimeout: 4000,
    });

    // Owl Carousel
    jQuery('.new-ato-slide').owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        autoplay: true,
        dots: false,
        nav: false,
        autoplayTimeout: 4000,
        rtl: true,
        navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            640: {
                items: 2,
            },
            768: {
                items: 3,
            },
            1024: {
                items: 4,
            }
        }
    });

    // Owl Carousel
    jQuery('.section-c-carousel').owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        autoplay: true,
        dots: false,
        autoplayHoverPause: true,
        nav: false,
        autoplayTimeout: 4000,
        navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            640: {
                items: 2,
            },
            1024: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });

    jQuery("#section-a-carousel").lightSlider({
        loop: true,
        vertical: false,
        auto: true,
        enableTouch: true,
        controls: false,
        pager: false,
        pauseOnHover: false,
        item: 3,
        speed: 800,
        pause: 3000,
        responsive: [{
                breakpoint: 991,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 10,
                }
            },
            {
                breakpoint: 639,
                settings: {
                    item: 1,
                    slideMove: 1,
                    slideMargin: 10,
                }
            }
        ]
    });

    jQuery('.md-show').parent('body').css({ 'background': 'red' });

    // Scroll From Other Pages
    if (window.location.hash) {
        setTimeout(function() {
            jQuery('html, body').scrollTop(0).show();
            jQuery('html, body').animate({
                scrollTop: jQuery(window.location.hash).offset().top - 90
            }, 1000)
        }, 0);
    } else {
        jQuery('html, body').show();
    }

    /*if(jQuery('.ywapo_group_container input[type=checkbox]:checked').length == 0){
      jQuery('.single_add_to_cart_button').prop('disabled', true);
    }
    else{
      jQuery('.single_add_to_cart_button').prop('disabled', false);
    }

    jQuery('.ywapo_group_container input[type=checkbox]').on('click', function(){
      if(jQuery('.ywapo_group_container input[type=checkbox]:checked').length == 0){
        jQuery('.single_add_to_cart_button').prop('disabled', true);
      }
      else{
        jQuery('.single_add_to_cart_button').prop('disabled', false);
      }
    });*/


    jQuery(".scroll, .scroll a").click(function(event) {
        var wd = jQuery(window).width();
        var gethash = jQuery(this).attr('href');
        if (gethash.indexOf('#') > -1) {
            event.preventDefault();
            var dest = 0;
            if (jQuery(this.hash).offset().top > jQuery(document).height() - jQuery(window).height()) {
                dest = jQuery(document).height() - jQuery(window).height();
            } else {
                if (wd < 750) {
                    dest = jQuery(this.hash).offset().top;
                } else {
                    dest = jQuery(this.hash).offset().top;
                }
            }
            //go to destination
            jQuery('html,body').animate({ scrollTop: dest }, 1000, 'swing');
        }
    });


    // Add animations
    if (jQuery('html').hasClass('.animate-in')) {
        var topcoords = jQuery('.animate-in').offset().top;
    }
    jQuery(function() {
        // Get each on load data attribute elements

        jQuery('.animate-in').each(function() {
            var animationStyle = jQuery(this).data('animation');
            if (animationStyle == 'load') {
                var animationSpeed = jQuery(this).data('speed');
                jQuery(this).addClass('animated');
                jQuery(this).css({ 'transition': animationSpeed + 's' });
            }
        });
        var jQueryelems = jQuery('.animate-in');
        var winheight = jQuery(window).height();
        var fullheight = jQuery(document).height();
        jQuery(window).scroll(function() {
            animate_elems();
        });

        function animate_elems() {
            var wintop = jQuery(window).scrollTop();
            jQueryelems.each(function() {
                var jQueryelm = jQuery(this);
                var animationShow = jQueryelm.data('show-screen');
                var animationSpeed = jQueryelm.data('speed');
                var topcoords = jQueryelm.offset().top;
                if (wintop > (topcoords - (winheight * animationShow))) {
                    jQueryelm.addClass('animated');
                    jQueryelm.css({ 'transition': animationSpeed + 's' });
                }

            });

        }
    });

});

// Tab Auto Rotate
var tabCarousel = setInterval(function() {
    var tabs = jQuery('.nav-tabs > li'),
        active = tabs.filter('.active'),
        next = active.next('li'),

        toClick = next.length ? next.find('a') : tabs.eq(0).find('a');

    toClick.trigger('click');
}, 5000);

// Google Language Select

jQuery(document).ready(function() {
    jQuery('#google_translate_element').bind('DOMNodeInserted', function(event) {
        jQuery('.goog-te-menu-value span:first').html('English');
        jQuery('.goog-te-menu-frame.skiptranslate').load(function() {
            setTimeout(function() {
                jQuery('.goog-te-menu-frame.skiptranslate').contents().find('.goog-te-menu2-item-selected .text').html('Translate');
            }, 100);
        });
    });
});