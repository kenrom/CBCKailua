/*jshint -W117 */

// Scrolls to the selected menu item on the page
$(function () {
  $('a[href*=#]:not([href=#])').click(function () {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') || location.hostname === this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 45
        }, 1000);
        // return false;
      }
    }
  });

  $('#submit').on("click", function (){ //an extra push for Chrome on Android, as form submit can stick on some devices
    $("#phpformmailer").validate();
  });
  
  var form = $("#phpformmailer");

  $.validator.setDefaults({
    //debug: true,

    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: "process.php", //process to mail
        data: $('form#phpformmailer').serialize(),
        success: function (msg) {
          $("#contact-well").html(msg) // show thank you & message
        },
        error: function () {
          alert("failure");
        }
      });
    }
  });
  $("#phpformmailer").validate({
    rules: {
      name: {
        minlength: 2,
        maxlength: 30,
        required: true
      },
      email: {
        required: true,
        email: true
      },
      phone: {
        required: true,
        phoneUS: true
      }
    },
    messages: {
      name: {
        required: "Please tell us your name",
        name: "Please tell us your name"
      },
      email: {
        required: "We need your email address to contact you",
        email: "Your email address must be in the format of name@domain.com"
      },
      phone: {
        required: "We need your phone number to call you",
        phone: "Your phone number must be valid."
      },
      message: {
        required: "What message do you want to send?"
      }
    }
  });

  $('.nav.navbar-nav > li').on('click', function (e) {
    $('.nav.navbar-nav > li').removeClass('active');

    $(this).addClass('active');

  });

});
