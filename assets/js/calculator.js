jQuery(function($) {
    console.log("Calculator initiailized");
    "use strict";

    function init_sliders(id) {
        console.log("Initializing sliders for ID:", id);
        var stripped_type = id.replace('-tab', '');
        slider(stripped_type);
        get_values(stripped_type);
    }

    $(window).on('load', function() {
        var id = $('.tabwrapper').find('a.active').attr('id');
        init_sliders(id);
    });

    $('body').on('click', '.tabwrapper a.nav-link', function() {
        var id = $(this).attr('id');
        console.log("Tab click event triggered for ID:", id);
        init_sliders(id);
    });

    function slider(type) {
        console.log("Initializing slider for type:", type);
        const selectors = {
            loan_select: $("#loan-term-" + type),
            amount_select: $("#amount-" + type),
            interest_select: $("#interest-" + type),
            residual_select: $("#residual-" + type),
            loan_slider: $("#slider-loan-" + type),
            amount_slider: $("#slider-" + type),
            interest_slider: $("#slider-interest-" + type),
            residual_slider: $("#slider-residual-" + type)
        };

        const minMaxLoan = type == 'Mortgage' || type == 'Chattel-Mortgage' ? {min: 1, max: 6} : {min: 1, max: 5};

        selectors.loan_slider.slider({
            min: minMaxLoan.min,
            max: minMaxLoan.max,
            range: "min",
            value: selectors.loan_select[0].selectedIndex + 1,
            slide: function(event, ui) {
                console.log("Loan slider moved. New value:", ui.value);
                selectors.loan_select[0].selectedIndex = ui.value - 1;
                $("#" + type + "-loan").attr("value", selectors.loan_select.val()).trigger('change');
            }
        });

        selectors.amount_slider.slider({
            min: 0,
            max: 1000000,
            range: "min",
            value: get_number(selectors.amount_select.val()),
            step: 1000,
            slide: function(event, ui) {
                console.log("Amount slider moved. New value:", ui.value);
                selectors.amount_select.val(ui.value);
                $("#" + type + "-amount").attr("value", selectors.amount_select.val()).trigger('change');
            }
        });

        selectors.interest_slider.slider({
            min: 1,
            max: 75,
            range: "min",
            value: selectors.interest_select[0].selectedIndex + 1,
            slide: function(event, ui) {
                console.log("Interest slider moved. New value:", ui.value);
                selectors.interest_select[0].selectedIndex = ui.value - 1;
                $("#" + type + "-interest").attr("value", selectors.interest_select.val() + "%").trigger('change');
            }
        });

        selectors.residual_slider.slider({
            min: 0,
            max: 100,
            range: "min",
            value: get_number(selectors.residual_select.val()),
            step: 1,
            slide: function(event, ui) {
                console.log("Residual slider moved. New value:", ui.value);
                selectors.residual_select.val(ui.value);
                $("#" + type + "-residual").attr("value", selectors.residual_select.val() + "%").trigger('change');
            }
        });

        setupEventHandlers(type, selectors);
    }

    function setupEventHandlers(type, selectors) {
        $("body").on("change keyup", "#loan-term-" + type + ", #amount-" + type + ", #interest-" + type + ", #residual-" + type, function() {
            console.log("Change or keyup event triggered for input:", this.id);
            get_values(type);
        });

        $('#payment-' + type).on('change', function() {
            console.log("Payment option changed for type:", type);
            var value = $(this).is(':checked') ? "Yes" : "No";
            $("#" + type + "-payment").attr("value", value).trigger('change');
        });

        $('#quote-' + type).on('click', function(e) {
            e.preventDefault();
            console.log("Quote button clicked for type:", type);
            submitForm(type);
        });
    }

    function get_values(type) {
        console.log("Getting values for type:", type);
        var loan = get_number($("#" + type + "-loan").val()),
            amount = get_number($("#" + type + "-amount").val()),
            interest = get_number($("#" + type + "-interest").val()),
            residual = get_number($("#" + type + "-residual").val()),
            payment = $('#payment-' + type).is(':checked') ? 1 : 0,
            total_val = calculation(loan, amount, interest, residual, payment);

        console.log("Calculation results for", type, ":", total_val);
        $('#' + type + '-total').attr("value", util_addCommas(util_round(total_val, 100.0)));

        if ($('#' + type + '-weekly-total').length) {
            var total_weekly_val = total_val / 4.3;
            $('#' + type + '-weekly-total').attr("value", util_addCommas(util_round(total_weekly_val, 100.0)));
        }
    }

    function submitForm(type) {
        // Your existing form submission code
    }

    function get_number(str) {
        var num = str.replace(/[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi, '');
        return parseFloat(num) || 0; // Ensure a number is always returned
    }

    function calculation(loan_term, amount_financed, interest_rate, balloon_percentage, payments_in_arrears) {
        // Your existing calculation function
    }

    function util_addCommas(nStr) {
        nStr += '';
        var parts = nStr.split('.'),
            main = parts[0],
            len = main.length,
            output = '',
            i = len - 1;

        while(i >= 0) {
            output = main.charAt(i) + output;
            if ((len - i) % 3 === 0 && i > 0) {
                output = ',' + output;
            }
            --i;
        }

        // Include decimal part if present
        if (parts.length > 1) {
            output += '.' + parts[1];
        }
        return output;
    }

    function util_round(number, digits) {
        return Math.round(number * digits) / digits;
    }
});
