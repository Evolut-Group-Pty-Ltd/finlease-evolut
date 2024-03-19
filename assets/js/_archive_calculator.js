jQuery( function($) {
    function init_sliders(id) {
        var stripped_type = id.replace('-tab', '');

        slider(stripped_type);
        get_values(stripped_type);
    }

    $(window).on('load', function(){
        var id = $('.tabwrapper').find('a.active').attr('id');
        init_sliders(id);
    });

    $('body').on('click', '.tabwrapper a.nav-link', function(){
        var id = $(this).attr('id');
        init_sliders(id);
    });

    function slider( type ){
        var loan_select = $( "#loan-term-" + type );
        var amount_select = $( "#amount-" + type );
        var interest_select = $( "#interest-" + type );
        var residual_select = $( "#residual-" + type );

        if(type == 'Mortgage' || type == 'Chattel-Mortgage'){
    
            var loan_slider = $( "#slider-loan-"+type ).slider({	        
                min: 1,
                max: 6,
                range: "min",
                value: loan_select[ 0 ].selectedIndex + 1,
                slide: function( event, ui ) {
                    loan_select[ 0 ].selectedIndex = ui.value - 1;
                    $("#"+type+"-loan").attr("value", loan_select.val());
                    $("#"+type+"-loan").trigger('change');
                }
            });
        }else{
            var loan_slider = $( "#slider-loan-"+type ).slider({	        
                min: 1,
                max: 5,
                range: "min",
                value: loan_select[ 0 ].selectedIndex + 1,
                slide: function( event, ui ) {
                    loan_select[ 0 ].selectedIndex = ui.value - 1;
                    $("#"+type+"-loan").attr("value", loan_select.val());
                    $("#"+type+"-loan").trigger('change');
                }
            });
        }
                        
        var amount_slider = $( "#slider-"+type ).slider({
            min: 0,
            max: 1000000,
            range: "min",
            value: get_number(amount_select.val()),
            step: 1000,
            slide: function( event, ui ) {
                // amount_select.val("$" + util_addCommas(ui.value));
                amount_select.val(ui.value);
                $("#"+type+"-amount").attr("value", amount_select.val());
                $("#"+type+"-amount").trigger('change');
            }
        });
        var interest_slider = $( "#slider-interest-"+type ).slider({
            min: 1,
            max: 75,
            range: "min",
            value: interest_select[ 0 ].selectedIndex + 1,
            slide: function( event, ui ) {
                interest_select[ 0 ].selectedIndex = ui.value - 1;
                $("#"+type+"-interest").attr("value", interest_select.val()+"%");
                $("#"+type+"-interest").trigger('change');
            }
        });

        var residual_slider = $( "#slider-residual-"+type ).slider({
            min: 0,
            max: 100,
            range: "min",
            value: residual_select.val(),
            step: 1,
            slide: function( event, ui ) {
                residual_select.val(ui.value);
                // residual_select.val( ui.value );
                $("#"+type+"-residual").attr("value", residual_select.val()+"%");
                $("#"+type+"-residual").trigger('change');
            }
        });

        $("body").on( "change", "#loan-term-" + type, function() {
            loan_slider.slider( "value", this.selectedIndex + 1 );
            $("#"+type+"-loan").attr("value", $(this).val());
            $("#"+type+"-loan").trigger('change');
        });

        $("body").on( "keyup", "#amount-" + type, function () {
            // var value = this.value.substring(1);
            // amount_slider.slider("value", parseInt(value));
            // var $this = $(this);
            
            var amount_val = this.value.replace('$','');
            amount_slider.slider("value", amount_val);
            $("#"+type+"-amount").attr("value", "$"+util_addCommas(amount_val));
            $("#"+type+"-amount").trigger('change');
        });

        $("body").on( "change", "#interest-" + type, function () {
            interest_slider.slider( "value", this.selectedIndex + 1 );
            $("#"+type+"-interest").attr("value", $(this).val()+"%");
            $("#"+type+"-interest").trigger('change');
        });

        $("body").on( "keyup", "#residual-" + type, function () {
            
            // if(parseInt($(this).val()) > 100){
            //     $("#"+type+"-residual").html('value cannot be greater then 100');
            //     $(this).val('');
            // }
            // var value = this.value.substring(1);
            // residual_slider.slider("value", parseInt(value));
            var $this = $(this);
            residual_slider.slider("value", this.value);
            $("#"+type+"-residual").attr("value", $(this).val()+"%");
            $("#"+type+"-residual").trigger('change');
        });

        $('#payment-' + type).on('change', function() {
            if($(this).is(':checked')) {
                $("#"+type+"-payment").attr("value", "Yes");
            } else {
                $("#"+type+"-payment").attr("value", "No");
            }
            $("#"+type+"-payment").trigger('change');
        });


        $('#fl-'+ type +' input').on( 'change', function() {
            get_values(type);
        } );

        //Get a quote
        $('#quote-'+type).on('click', function(e){
            e.preventDefault();
            var loan        = $("#"+type+"-loan").val(),
                amount      = $("#"+type+"-amount").val(),
                interest    = $("#"+type+"-interest").val(),
                residual    = $("#"+type+"-residual").val(),
                payment     = $("#"+type+"-payment").val(),
                total     = $("#"+type+"-total").val(),
                link        = $(this).attr('href'),
                form = $('<form action="' + link + '" method="get">' +
            '<input type="text" name="type" value="' + type + '" />' +
            '<input type="text" name="loan" value="' + loan + '" />' +
            '<input type="text" name="amount" value="' + amount + '" />' +
            '<input type="text" name="interest" value="' + interest + '" />' +
            '<input type="text" name="residual" value="' + residual + '" />' +
            '<input type="text" name="payment" value="' + payment + '" />' +
            '<input type="text" name="total" value="' + total + '" />' +
            '</form>');
            $('body').append(form);
            form.submit();
        }) 
        }

    function get_values(type){
        var loan = get_number( $("#"+type+"-loan").val() ),
            amount = get_number( $("#"+type+"-amount").val() ),
            interest = get_number( $("#"+type+"-interest").val() ),
            residual = get_number( $("#"+type+"-residual").val() );
            // console.log(loan);
            // console.log(amount);
            // console.log(interest);
            // console.log(residual);
        if($('#payment-' + type).is(':checked')) {
            payment = 1;
        }
        else {
            payment = 0;
        }
        var total_val = calculation( loan, amount, interest, residual, payment );
        $('#'+type+'-total').attr( "value", util_addCommas(util_round(total_val, 100.0)) );

		if ( $('#'+type+'-weekly-total').length ) {
	        var total_weekly_val = total_val/4.3;
			$('#'+type+'-weekly-total').attr( "value", util_addCommas(util_round(total_weekly_val, 100.0)) );
		}
    }

    function get_number(str) {
        var num = str.replace(/[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi,'');
        return num;
    }

    function calculation( loan_term, amount_financed , interest_rate, balloon_percentage, payments_in_arrears ){
        var ir, s, m;		
        ir = interest_rate / 100.0 / 12.0;	
        s = 0.0;		
        if (payments_in_arrears == 1) {		
            for (m = 1; m <= loan_term; m++) {
                s = s + 1.0 / Math.pow(1 + ir, m);
            };			
        } else {		
            for (m = 0; m < loan_term; m++) {
                s = s + 1.0 / Math.pow(1 + ir, m);
            };		
        };		
        return amount_financed * (1.0 - balloon_percentage / 100.0 / Math.pow(1 + ir, loan_term)) / s;

    }

    function util_addCommas(nStr) {
        var x, x1, x2;
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    };

    function util_round(number, digits) {
        return Math.round(number * digits) / digits;
    };

    function util_addCommas(nStr) {	
        var x, x1, x2;	
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;	
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }	
        return x1 + x2;
    };
} );