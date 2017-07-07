$(document).ready(function(){

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

    $('#categories').change(function(){
        var id=$(this).val();

        $.ajax({
            type: "GET",
            url: APP_URL + '/Deals/getSubcatData/' + id,
            dataType: 'json',
            data: id,
            success: function(data) {



                $.each(data,function (index,value) {
                    console.log(value.id);
                    console.log(value.subcategories_name);
                    $('.subcategories').after("<option value="+value.id+">"+ value.subcategories_name+" </option>");

                });
            }

        });

    });

});