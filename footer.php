    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
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
            } else {

                $('#email').addClass('invalid');
                $("#email").prop("aria-invalid", "true");
            }
        }

        $(document).ready(function(){
            $("#email").blur(validate);
        });

//--------------Phone Validation function--------------------------

        $(document).ready(function() {
            $('#phone').blur(function(e) {
                if (!validatePhone('phone')) {
                  $('#phone').addClass('invalid');
                   $("#phone").prop("aria-invalid", "true");
                }else{
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
                      $('#name').addClass('invalid');
                      $("#name").prop("aria-invalid", "true");
                }else{
                }
            });
        });
        
        $(document).ready(function(){




                $('#gridRadios1').change(function(){

                        $('#gridRadios2').prop('checked', false);
                        $('#genderStatusID').attr("value","M");
                });

                $('#gridRadios2').change(function(){

                        $('#gridRadios1').prop('checked', false);
                        $('#genderStatusID').attr("value","F");
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

      						var today = new Date(),
      										dob = new Date($(this).val()),
      										age = new Date(today - dob).getFullYear() - 1970;

      								$('#age').val(age);
                console.log($(this).val());




        });
        $(function() {
        $('#kiitianSelector').change(function(){
                $('.kiitianSelection').hide();
                $('#' + $(this).val()).show();
            });
        });

    function preventDupes( select, index ) {
        var options = select.options,
            len = options.length;
        while( len-- ) {
            options[ len ].disabled = false;
        }
        select.options[ index ].disabled = true;
        if( index === select.selectedIndex ) {
            alert('You\'ve already selected the item "' + select.options[index].text + '".\n\nPlease choose another.');
            this.selectedIndex = 0;
        }
    }

    var select1 = select = document.getElementById( 'select1' );
    var select2 = select = document.getElementById( 'select2' );

    select1.onchange = function() {
        preventDupes.call(this, select2, this.selectedIndex );
    };

    select2.onchange = function() {
        preventDupes.call(this, select1, this.selectedIndex );
    };

//------------------AJAX for form submission------------------------
$('#submitAnchor').click(function(){
        $('form.ajax').submit();
});
$('form.ajax').on('submit',function(){

        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};

	

        that.find('[name]').each(function(index, value){
            var that = $(this),
                name = that.attr('name'),
                value = that.val();
			
            data[name] = value;
            //data[csrf] = $("#csrf").val();
        });
		
			data['captcha'] = grecaptcha.getResponse();
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response){
		
		grecaptcha.reset();
		console.log(response);
                response=JSON.parse(response);
                console.log(response.errorStatus+"- "+response.error);
                if(response.errorStatus)
                {
                        $('.alert-danger').show();
                        $('.alert-danger').html(response.error);
                        console.log("LOL");
                	        
                        
						
                }
                else{
                        console.log("LOYOLA");
                        $('#modal1').css('display','block');
                        $('#modal1').css('z-index','100');
                        $('#modal1').css('color','black');
                        document.getElementById('submitAnchor').disabled = true;
                        //window.location.href="http://localhost/kweb/sessions.php";
                }

            }
        });

        return false;
    });


    </script>
