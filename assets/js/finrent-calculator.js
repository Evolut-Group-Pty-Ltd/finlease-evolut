jQuery( function($) {

  $(window).on('load', function() {
    finrent_sliders();
    getValues();
  })
 
  var loan_select = $( "#loan-term");
  var amount_select = $( "#amount-slider-val");
  var machine_select = $("#machine-slider-val");

  var machine_val = $("#machine-slider-val").val();


  function finrent_sliders() {

    var loan_slider = $( "#slider-loan-term" ).slider({	        
      min: 1,
      max: 5,
      range: "min",
      value: loan_select[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
          loan_select[ 0 ].selectedIndex = ui.value - 1;
          $("#loan-val-calc").html(loan_select.val());
          // $("#loan-val-calc").trigger('change');
          getValues();
      }
    });
  
    $("body").on( "change", "#loan-term", function() {
      loan_slider.slider( "value", this.selectedIndex + 1 );
      $("#loan-val-calc").html($(this).val());
      // $("#loan-val-calc").trigger('change');
      getValues();
    });
  
    var amount_slider = $( "#amount-slider" ).slider({
      min: 2000,
      max: 1200000,
      range: "min",
      value: get_number(amount_select.val()),
      step: 1000,
      slide: function( event, ui ) {
          // amount_select.val("$" + util_addCommas(ui.value));
          amount_select.val(ui.value);
          $("#amount-slider-val-calc").html('$' + amount_select.val());
          // $("#amount-slider-val-calc").trigger('change');
          getValues();
      }
    });
  
    $("body").on( "keyup", "#amount-slider-val", function() {
      var $this = $(this);
      amount_slider.slider( "value", this.value );
      $("#amount-slider-val-calc").html('$' + amount_select.val());
      // $("#amount-slider-val-calc").trigger('change');
      getValues();
    });
  
    var machine_slider = $( "#machine-slider" ).slider({
      min: 1,
      max: 1000,
      range: "min",
      value: get_number(machine_select.val()),
      step: 1,
      slide: function( event, ui ) {
          // amount_select.val("$" + util_addCommas(ui.value));
          machine_select.val(ui.value);
          $("#machines-val-calc").html(machine_select.val());
          $("#machines-val-calc").trigger('change');
          getValues();
      }
    });
  
    $("body").on( "keyup", "#machine-slider-val", function() {
      var $this = $(this);
      machine_slider.slider( "value", this.value );
      $("#machines-val-calc").html(machine_select.val());
      // $("#machines-val-calc").trigger('change');
      getValues();
    });
  }

  function get_number(str) {
    var num = str.replace(/[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi,'');
    return num;
  }

  
  // calculation
  function PMT(rate, np, pv, fv, type){
    // console.log(rate, np, pv, fv, type);
    var machines = $('#machine-slider-val').val();

    if(!fv){
        fv = 0;
    }
    if(!type){
        type = 0;
    }
    let pvif = Math.pow(1 + rate, np);
    let pmt = rate / (pvif -1) * (pv * pvif + fv); //-(pv * pvif + fv); add the - to inverse pmt value

    if(type == 1) {
        pmt /= (1 + rate);
    };
    // console.log(pmt);

    //pushing calcs to the innerText of the — placeholders
    let excGst = document.querySelector('#calc-excluding-gst');
        excGst.innerText = Number(pmt).toFixed(2); //calculating 'calc1' based on pmt - all others are based on calc1
    let gstOnly = document.querySelector('#calc-gst-only');
        gstOnly.innerText = Number(excGst.innerText * 0.1).toFixed(2);
    let incGst = document.querySelector('#calc-including-gst');
        incGst.innerText = (Number(excGst.innerText) + Number(gstOnly.innerText)).toFixed(2);
    let monthCostPer = document.querySelector('#calc-machine-monthly-excluding-gst');
        monthCostPer.innerText = (Number(excGst.innerText) / Number(machines)).toFixed(2);       
    let dayCostPer = document.querySelector('#calc-daily-machine-excluding-gst');
        dayCostPer.innerText = (Number(excGst.innerText *12 / 365 / Number(machines))).toFixed(2);

	let excGstWeekly =  document.getElementById('calc-excluding-gst-weekly');
	if ( typeof(excGstWeekly) != 'undefined' && excGstWeekly != null ) {
		excGstWeekly.innerText = Number((excGst.innerText * 12) / 52).toFixed(2); //calculating 'calc1' based on pmt - all others are based on calc1
	    let gstOnlyWeekly = document.querySelector('#calc-gst-only-weekly');
	        gstOnlyWeekly.innerText = Number(excGstWeekly.innerText * 0.1).toFixed(2);
	    let incGstWeekly = document.querySelector('#calc-including-gst-weekly');
	        incGstWeekly.innerText = (Number(excGstWeekly.innerText) + Number(gstOnlyWeekly.innerText)).toFixed(2);

		excGstWeekly.innerText = '$' + excGstWeekly.innerText;
		gstOnlyWeekly.innerText = '$' + gstOnlyWeekly.innerText;
		incGstWeekly.innerText = '$' + incGstWeekly.innerText;
	}

	excGst.innerText = '$' + excGst.innerText;
	gstOnly.innerText = '$' + gstOnly.innerText;
	incGst.innerText = '$' + incGst.innerText;
	monthCostPer.innerText = '$' + monthCostPer.innerText;
	dayCostPer.innerText = '$' + dayCostPer.innerText;

    return pmt;
  }

  function getValues() {
    var term = $('#loan-term').val(),
		amount = $('#amount-slider-val').val(),
		machines = $('#machine-slider-val').val(),
		interest_rate = $('#interest-rate-val').val(),
		brokerage = $('#brokerage-val').val();

    //PMT values for calculation
    let actualRate = interest_rate;
    let brokerageRate = brokerage;
    let months = 12;
    // let years = parseInt(document.querySelector('select#term').value) / 12;
    let years = parseInt(term) / 12;
    // let loanAmount = parseInt(document.querySelector('input#totalValue').value);
    let loanAmount = parseInt(amount);
    let brokerageAmount = brokerageRate * amount;

    let totalLoanAndBrokerageAmount = loanAmount + brokerageAmount;

    PMT(actualRate/months, years*months, totalLoanAndBrokerageAmount, 0, 1);

    $('#loan-val-calc').html(term);
    $('#amount-slider-val-calc').html('$' + amount);
    $('#machines-val-calc').html(machines);
  }
});