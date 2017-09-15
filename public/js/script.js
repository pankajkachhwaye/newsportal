$(document).ready(function(){

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    // configure your validation
    $("#add_attribute").validate({
        rules: {
            category_name: { valueNotEquals: "default" },

//		news_description:{valueNotEquals: ""}
        },
        messages: {
            category_name: { valueNotEquals: "Please select an item!" },
// news_description: { valueNotEquals: "Please add discription" }


        },highlight: function (input) {

            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
	errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }

    });

    if(status == 101){
        $.notify({
                message: message
            },
            {
                allow_dismiss: true,
                newest_on_top: true,
                timer: 1000,
                placement:{
                    from: 'top',
                    align: 'right'
                },
                animate: {
                    enter: 'animated rotateOutInRight',
                    exit: 'animated rotateOutUpRight '
                }
            });
    };

    $('#lang').change(function(){
        $('#lang_id').val('');
        $('#categories').empty();
        $('#categories').selectpicker('refresh');
        // var id=$(this).val();
        var id = $('#lang option:selected').attr('data-react-id');

        if(id == ''){
            return false;
        }
        else{
            $.ajax({
                type: "GET",
                url: APP_URL + '/category-by-lang/' + id,
                dataType: 'json',
                data: id,

                success: function(response) {
                    var tempoption = "<option value=''>Please select </option>";
                    $('#categories').append(tempoption);
                 $.each(response.data,function (index,value) {
                     var option = '<option value=' + value.id + '>' + value.category_name + '</option>';

                   var selector = $('#categories');
                     selector.append(option);

                    });
                    $('#categories').selectpicker('refresh');
                    $('#lang_id').val(id);
                }

            });
        }



    });

    $(document).on('click','.delete-image',function(){
        var that = $(this);
        var countImage = that.closest('.remove-me').attr('data-count');
        var id = $(this).attr('data-reactId');
        $.ajax({
            type: "GET",
            url: APP_URL + '/delete-news-image/' + id,
            dataType: 'json',
            data: id,

            success: function(response) {
             if(response.status){
                 var counter = that.closest('.remove-me').attr('data-count',--countImage);
                 if(countImage == 0){
                     $('#news_Image').attr('required',true);
                 }
                that.closest('.remove-me').remove();
                 $.notify({
                         message: response.message
                     },
                     {
                         allow_dismiss: true,
                         newest_on_top: true,
                         timer: 1000,
                         placement:{
                             from: 'top',
                             align: 'right'
                         },
                         animate: {
                             enter: 'animated rotateOutInRight',
                             exit: 'animated rotateOutUpRight '
                         }
                     });
             }
            }

        });
    });
    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };
    var all_user = [];
    $(document).on('change','#basic_checkbox_select_all',function () {
        var selectallVal = $(this).prop('checked');
        if(selectallVal == true){
            var selectcheck = $('.select-me');
            selectcheck.each(function (index,value) {
                $(this).prop('checked',true);
                var id = $(this).attr('data-react-id');
                all_user.push(id);
            })
        }
        else{
            var selectcheck = $('.select-me');
            selectcheck.each(function (index,value) {
                $(this).prop('checked',false);
                var id = $(this).attr('data-react-id');
                all_user.remove(id);
            })
        }
    })

    $(document).on('change','.particular-me',function () {
        var particularcheck = $(this).prop('checked');
        if(particularcheck == true){
            var id = $(this).attr('data-react-id');
            all_user.push(id);
        }
        else{
            var id = $(this).attr('data-react-id');
            all_user.remove(id);
        }
    });



    $(document).on('click','#send-to-selected',function () {

        if(all_user.length > 0){
            $('#notify-selected-modal').modal('show');
        }
        else {
            $.notify({
                    message: 'please select user to send notification'
                },
                {
                    allow_dismiss: true,
                    newest_on_top: true,
                    timer: 1000,
                    placement:{
                        from: 'top',
                        align: 'right'
                    },
                    animate: {
                        enter: 'animated rotateOutInRight',
                        exit: 'animated rotateOutUpRight'
                    }
                });
        }
 });



    $(document).on('click','#notify-registered-user',function () {
            var valid = $("#add_attribute").valid()
            if(valid){
                var notification_title = $('#notification_title').val();
                var notification_body = $('#notification_body').val();
                $.ajax({
                    type: "POST",
                    url: APP_URL + '/notify-selected-users',
                    dataType: 'json',
                    data: {'notification_title':notification_title,'notification_body':notification_body,'users':all_user},

                    success: function(response) {
                        console.log(response);
                    }

                });
            }
    });


    $('#btnAdd').click(function() {
        var num = $('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
            newNum = new Number(num + 1), // The numeric ID of the new input field being added, increasing by 1 each time
            newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
        newElem.find('.input_value').attr('id', 'value' + newNum).attr('name', 'news_image' + newNum).val('');
        newElem.find(':not([data-upgraded=""])').attr('data-upgraded', '');
        newElem.find('input[type=text]').attr('disabled',false);
        //Update the counter
        $('#counter').val(newNum);




        // Insert the new element after the last "duplicatable" input field
        $('#entry' + num).after(newElem);
        $('#ID' + newNum + '_title').focus();

        // Enable the "remove" button. This only shows once you have a duplicated section.
        $('#btnDel').attr('disabled', false);
        $('#btnDelEdit').attr('disabled', false);

    });

    $('#btnDel').click(function() {
        // Confirmation dialog box. Works on all desktop browsers and iPhone.
        // if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
        //     {
        var num = $('.clonedInput').length;
        // how many "duplicatable" input fields we currently have
        $('#entry' + num).slideUp('slow', function() {
            $(this).remove();

            $('#counter').val(num - 1);

            // if only one element remains, disable the "remove" button
            if (num - 1 === 1)
                $('#btnDel').attr('disabled', true);
            // enable the "add" button
            $('#btnAdd').attr('disabled', false).prop('value', "add section");
        });
        //    }
        return false; // Removes the last section you added
    });
    // Enable the "add" button
    $('#btnAdd').attr('disabled', false);
    // Disable the "remove" button
    $('#btnDel').attr('disabled', true);
    $('#btnDelEdit').attr('disabled', true);

});
