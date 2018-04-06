    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript">

        
    /***************Form validation****************/

        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

//--------------Email Validate function-----------------------
        function validate() {
            var email = $("#email").val();
            if (validateEmail(email)) {
              $("#checkEmail").text("Valid");
              $("#checkEmail").css("color", "green");
              $("#checkEmail").css("display", "inline");
            } else {
              $("#checkEmail").text("Invalid");
              $("#checkEmail").css("color", "red");
              $("#checkEmail").css("display", "inline");
            }
        }

        $(document).ready(function(){
            $("#email").blur(validate);
        });

//--------------Phone Validation function--------------------------

        $(document).ready(function() {
            $('#phone').blur(function(e) {
                if (!validatePhone('phone')) {
                    $('#spnPhoneStatus').text('Invalid');
                    $('#spnPhoneStatus').css('color', 'red');
                    $('#spnPhoneStatus').css('display', 'inline');
                }else{
                    $('#spnPhoneStatus').text('Valid');
                    $('#spnPhoneStatus').css('color', 'green');
                    $('#spnPhoneStatus').css('display', 'inline');
                }
            });
        });


        function validatePhone(phone) {
            var a = document.getElementById(phone).value;
            var filter = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/;
            if (filter.test(a)) {
                return true;
            }
            else {
                return false;
            }
        }

//--------------Name Validation function--------------------------

        $(document).ready(function() {
            $('#name').blur(function(e) {
                if (!validateName('name')) {
                    $('#nameStatus').text('Invalid');
                    $('#nameStatus').css('color', 'red');
                    $('#nameStatus').css('display', 'inline');
                }else{
                    $('#nameStatus').text('Valid');
                    $('#nameStatus').css('color', 'green');
                    $('#nameStatus').css('display', 'inline');
                }
            });
        });


        function validateName(name) {
            var a = document.getElementById(name).value;
            var filter = /^[a-zA-Z .]{2,}$/;
            if (filter.test(a)) {
                return true;
            }
            else {
                return false;
            }
        }


//-------Toggle rollno/university div on drop down select---------------

        $('#dob').change(function(){

                $('#age').val($(this).val());
                console.log($(this).val());




        });
        $(function() {
        $('#kiitianSelector').change(function(){
                $('.kiitianSelection').hide();
                $('#' + $(this).val()).show();
            });
        });


 //----------------------AGE Calculation---------------------------       
      $( function() {
        $('#dob').datepicker({
            onSelect: function(value, ui) {
                var today = new Date(), 
                    dob = new Date(value), 
                    age = new Date(today - dob).getFullYear() - 1970;
                
                $('#age').val(age);
            },
            maxDate: '+0d',
            yearRange: '1987:2017',
            changeMonth: true,
            changeYear: true
        });
      } );

//------------------AJAX for form submission------------------------
    
    $('form.ajax').on('submit',function(){


        console.log("Came hggd ");
        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};

        that.find('[name]').each(function(index, value){
            var that = $(this),
                name = that.attr('name'),
                value = that.val();

            data[name] = value;
        });

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response){


                console.log(response);
                
                response=JSON.parse(response);
                console.log(response.errorStatus+"- "+response.error);
                if(response.errorStatus)
                {
                        $('.alert-danger').show();
                        $('.alert-danger').html(response.error);

                }
                else{

                        window.location.href="http://localhost/kritarth/sessions.php";
                }

            }
        });

        return false;
    });
        

    </script>
  </body>
</html>