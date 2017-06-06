// this is here where calander
 $( function() {
    $( "#datepicker" ).datepicker({
      showWeek: true,
      firstDay: 1
    });
  } );

//this is whewe modal form diaplay
$( function() {
    var dialog, form,

      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );

    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }

    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }

    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }

    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );

      valid = valid && checkLength( name, "username", 3, 16 );
      valid = valid && checkLength( email, "email", 6, 80 );
      valid = valid && checkLength( password, "password", 5, 16 );

      valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
      valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

      if ( valid ) {
        $( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + email.val() + "</td>" +
          "<td>" + password.val() + "</td>" +
        "</tr>" );
        dialog.dialog( "close" );
      }
      return valid;
    }

    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });

    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });

    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
  } );

$('.sure').click(function(){ return confirm ('are you sure');});

// $('#mulSelect').multiSelect();
$('.mul').multiSelect({
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='searchTest'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='selectdTest'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});
// $("#pat").dataTable();
$("#pat").basictable({
    breakpoint: 768,
});
$("#doc").dataTable();
// $('#mulSelect').multiSelect('select_all');
$.datepicker.setDefaults({
  dateFormat:'yy-mm-dd'
});
$('#date').datepicker();
$('#filter').click(function(){
  var datepick  = $('#date').val();
  var idr  = $('#id').val();
      if(datepick){
            $.ajax({
              url : "ajax1.php",
              method  : "POST",
              data  :{dat:datepick, id:idr},
              success :function(data){ $('#pa-tab').html(data);}
            });

      }else{alert("insert date please")};

});
$('#from').datepicker();
$('#to').datepicker();
$('#dats').datepicker();
// bill filter
$('#filter1').click(function(){
    var from = $('#from').val();
    var to = $('#to').val();
    var id = $('#id').val();
    var bid = $('#bid').val();
    if(from && to){
        $.ajax({
            url : "ajaxbill.php",
            method :"POST",
            data : {from:from,to:to, id:id},
            success : function(data){
              $("#list-bills").html(data);
            }})}else{ alert('pick date please');}});
//statistc filter
    $("#filter2").click(function(){
      var date = $('#datepicker').val();
        if(date){
              $.ajax({
                url     : "staticajax.php",
                method  : "post",
                data    : {date:date},
                success : function(data){$("#static-ajax").html(data)  }  }); 
                 }else{alert('pick date please');}});

$("#testgroup").controlgroup();


// alerts
  $("#success-alert").fadeTo(2000, 500).slideUp(1000);

// alerts

// doctor statistics
          $('#doctype').datepicker();
          $("#filterdoc").click(function(){
              var date =  $('#doctype').val();
              var did = $("#did").val();
              var rate = $("#rate").val();
             if(!rate){
              alert("please choose rate");
             }
              if(date){
                $.ajax({
                    url     :"docajax.php",
                    method  :"post",
                    data    :{date:date,id:did,rate:rate},
                    success : function(data){$("#row").html(data);}});
                  }else{alert("choose date please");}
          });
      


// doctor statistics

// matreials monthly billing 
  $("#material").datepicker();
  $("#filtermat").click(function(){
    var date = $("#material").val();
    if(date){
              $.ajax({
                url: "materialajax.php",
                method:"post",
                data:{date:date},
                success:function(data){$("#materi").html(data);}
              });

    }else{alert("pick date please");}




  });
// matreials monthly billing 
// tests jobs
      
      $("#testsss").dataTable();
      $("#groip").select2({
        placeholder: "Select a Group"
      });
      $("#searchgroup").click(function(){
        var group =$("#groip").val();
        if(group){
              $.ajax({
                  url:"testajax.php",
                  method:"post",
                  data:{group:group},
                  success:function(data){$("#testshow").html(data);}

              });

        }else{
          alert("choosoe group please");
        }

      });
// tests jobs

// calendar

//pending
$(".pending").click(function(){
 swal({
  title: "Are you sure?",
  text: "You will not be able to edit the bill again !",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, pending it!",
  closeOnConfirm: false
},
function(){swal("pending!", "Your bill has been pending.", "success");});});

$("#pend").dataTable();
//pending

$(function() {
  
  initDropDowns($("div.shy-menu"));

});

function initDropDowns(allMenus) {

  allMenus.children(".shy-menu-hamburger").on("click", function() {
    
    var thisTrigger = jQuery(this),
      thisMenu = thisTrigger.parent(),
      thisPanel = thisTrigger.next();

    if (thisMenu.hasClass("is-open")) {

          thisMenu.removeClass("is-open");
      
          jQuery(document).off("click");                                 
          thisPanel.off("click");

    } else {      
      
        allMenus.removeClass("is-open");  
      thisMenu.addClass("is-open");
  
      jQuery(document).on("click", function() {
        allMenus.removeClass("is-open");
      });
      thisPanel.on("click", function(e) {
        e.stopPropagation();
      });
    }
    
    return false;
  });
}

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();


  //clock
    

       $('.clock').FlipClock({
          clockFace: 'TwelveHourClock',
          showSeconds: false
        });
  //clock

 
  // basictablebasictable
  $("#table").dataTable();
   $('#table').basictable();

      $('#table-breakpoint').basictable();
       $('#tab').basictable({

         breakpoint: 2000
       });

      $('#table-container-breakpoint').basictable({
        containerBreakpoint: 485
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });

  // basictablebasictable
  $(".menu").hide();
  $("#show").click(function(){
    $(".menu").show().hide(5000);

  });