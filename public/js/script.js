$(document).ready(function(){

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    // configure your validation
    $("#add_attribute").validate({
        rules: {
            category_name: { valueNotEquals: "default" }
        },
        messages: {
            category_name: { valueNotEquals: "Please select an item!" }
        },highlight: function (input) {

            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
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
    var all_user = {};
    $(document).on('change','#basic_checkbox_select_all',function () {
        var selectallVal = $(this).prop('checked');
        if(selectallVal == true){
            var selectcheck = $('.select-me');
            selectcheck.each(function (index,value) {
                $(this).prop('checked',true);
            })
        }
        else{
            var selectcheck = $('.select-me');
            selectcheck.each(function (index,value) {
                $(this).prop('checked',false);
            })
        }
    })

    $(document).on('change','particular-me',function () {
        var particularcheck = $(this).prop('checked');
        if(selectallVal == true){
                $(this).prop('checked',true);
        }
        else{
                $(this).prop('checked',false);
        }
    });
    // $('#basic_checkbox_select_all').change()


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