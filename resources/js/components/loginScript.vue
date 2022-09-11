<template>
  <div></div>
</template>
<script>
export default {
  data: function () {
    return {
      username: "",
      password: "",
      error: "",
    };
  },
  methods: {
    singleValidate: function (id) {
      $("#" + id).css("border", "1px solid #e45");
      $(".requiredv").remove();
      $("#" + id).after(
        '<span class="text-danger requiredv">Required !</span>'
      );
    },
    validateI: function (id, sel = 0, psw = false) {
      if (sel === 0) {
        let index = -1;
        let $vm = this;

        if ($("#" + id).val() == "") {
          $("#" + id).css("border", "1px solid #e45");
          $(".requiredv").remove();
          $("#" + id).after(
            '<span class="text-danger requiredv">Required !</span>'
          );
          return false;
        } else {
          return $("#" + id).val();
        }
      }
      if (sel === 1) {
        if ($("#" + id + "option:selected").text() == "") {
          $("#" + id).css("border", "1px solid #e45");
          $(".requiredv").remove();
          $("#" + id).after(
            '<span class="text-danger requiredv">Required !</span>'
          );
          return false;
        } else {
          return true;
        }
      }
    },
    submitNow() {
      let $vm = this;
      $vm.username = $vm.validateI("username");
      $vm.password = $vm.validateI("password");

      if ($vm.username != "" && $vm.password != "") {
        /* var formContents = jQuery("#login-form").serialize();
         */

        $("#login-msg-loader").show();
        $("#login-err2").hide();
        $("#login-err").hide();
        try {
          $vm.axios
            .post("api/login", {
              username: $vm.username,
              password: $vm.password,
            })
            .then(
              function (response, status, request) {
                $("#login-msg-loader").hide();
                $("#login-msg-success").show();
                $("#login-msg-success.checkmark").show();
                if (response.status === 200) {
                  localStorage.setItem(
                    "LoggedUser",
                    JSON.stringify(response.data)
                  );

                  /*update store*/
                  $vm.$store.dispatch("updateUser", response);

                  $("#response-data").val(JSON.stringify(response));
                  $(".check-icon").show();

                  $("#auto-redirect").submit();
                  $("#login-msg").css("display", "none");
                } else {
                  $("#login-msg").css("display", "none");
                  $("#login-err").show();
                }
              },
              function (e) {
                if (e.response.status === 401) {
                  $("#login-msg").css("display", "none");
                  $("#login-msg-loader").hide();

                  $("#login-err").show();
                } else {
                  $("#login-msg-loader").hide();
                  $("#login-err2").show();
                }
              }
            );
        } catch (err) {
          $("#login-msg-loader").hide();
          $("#login-err2").show();
        }
      }
    },
  },

  created: function () {},
  mounted() {
    let $vm = this;
    this.$nextTick(function () {

      $('#username, #password').click(function(){  
        $("#login-box-119").addClass('pos-shift')

        $("#login-box-120").removeClass('col-lg-6 col-md-6')         
        //  $("#login-box-119").css('display','none');
          $("#login-box-120").animate({
            right:'10%',
          },500)       /* 
        setTimeout(function(){
        },100) */
        //$("#login-box-120").addClass('w-100')        
      })
  $(document).click(function(e) {

      // check that your clicked
      // element has no id=info

      if( e.target.id != 'username' && e.target.id != 'password' ) {       
        $("#login-box-119").css('display','flex');
          $("#login-box-120").removeClass('w-100')    
          $("#login-box-120").animate({
            right:'0%',
          },500)        
          setTimeout(function(){      
            $("#login-box-120").addClass('col-lg-6 col-md-6')        
            $("#login-box-119").removeClass('pos-shift')
          },10)
      }
    }); 
           
      
      $("#username, #password").keyup(function () {
        $(this).css("border", "1px solid #bbb");
        $(this).next(".requiredv").remove();
      });
      try {
      } catch (err) {}

      $("#togglePwDisplay").click(function () {
        var contX = $(this).text();
        if (contX === "show") {
          $(this).prev().attr("type", "text");
          $(this).text("hide");
        } else if (contX === "hide") {
          $(this).prev().attr("type", "password");
          $(this).text("show");
        }
      });

      $("#password").keyup(function (e) {
        if (e.key === "Enter" || e.keyCode === 13) {
          $vm.submitNow();
        }
      });
      $("#login-btn").click(function () {
        $vm.submitNow();
      });
    });
    

    consoleText(
      ["Hello Virtual User.", "Welcome to Virtual Laboratory", "Please Login"],
      "textAnim",
      ["#2083af", "#2083af", "#2083af"] 
    );

    function consoleText(words, id, colors) {
      if (colors === undefined) colors = ["#fff"];
      var visible = true;
      var con = document.getElementById("console");
      var letterCount = 1;
      var x = 1;
      var waiting = false;
      var target = document.getElementById(id);
      target.setAttribute("style", "color:" + colors[0]);
      window.setInterval(function () {
        if (letterCount === 0 && waiting === false) {
          waiting = true; 
          target.innerHTML = words[0].substring(0, letterCount);
          window.setTimeout(function () {
            var usedColor = colors.shift();
            colors.push(usedColor);
            var usedWord = words.shift();
            words.push(usedWord);
            x = 1;
            target.setAttribute("style", "color:" + colors[0]);
            letterCount += x;
            waiting = false;
          }, 1000);
        } else if (letterCount === words[0].length + 1 && waiting === false) {
          waiting = true;
          window.setTimeout(function () {
            x = -1;
            letterCount += x;
            waiting = false;
          }, 1000);
        } else if (waiting === false) {
          target.innerHTML = words[0].substring(0, letterCount);
          letterCount += x;
        }
      }, 120);
      window.setInterval(function () {
        if (visible === true) {
          con.className = "console-underscore hidden";
          visible = false;
        } else {
          con.className = "console-underscore";

          visible = true;
        }
      }, 400);
    }

    $(document).ready(function(){
        $("#bottomElements").addClass('offset-md-6 col-md-6')
    });
  },
};
</script>