
$(document).ready(function(){
    // clicking button with class "category-button"
    $("#course-categories .category-button").click(function(){
        // get the data-filter value of the button
        $('.loading').show();
        var self=$(this);
        var catid = self.attr('course-category');
        var currency=$('#currency').attr('current-currency');
        //alert(catid);
         $.ajax({
                url: 'getcourses.php',
                type: 'post',
                data: {filter:catid,currency:currency},
                success: function( data ){
                    var splitted=data.split("|@");
                    $('#cat-courses').html(splitted[0] );
                    $('.loading').hide();
                    $('#coursecat').html(splitted[1] );  
                    $('#currency').attr('current-category',catid);
                    $('#currencyselector').show();     

                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        self.siblings().removeClass('active');
        self.toggleClass('active');
        $('#sptbreadcrumb').siblings().removeClass('active');
       $('#cat-courses').hide();
       $("#cat-courses").animate({width:'toggle'},350);
    });

$('#currency').change(function(){

$('.loading').show();
        var currency = $(this).val();
        var catid=$('#currency').attr('current-category');
        
        //alert(catid);
         $.ajax({
                url: 'getcourses.php',
                type: 'post',
                data: {filter:catid,currency:currency},
                success: function( data ){
                    var splitted=data.split("|@");
                    $('#cat-courses').html(splitted[0] );
                    $('.loading').hide();
                    $('#coursecat').html(splitted[1] );  
                    $('#currency').attr('current-category',catid);     
                    $('#currency').attr('current-currency',currency);
                    $('#currencyselector').show();     

                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        $('#cat-courses').hide();
       $("#cat-courses").animate({width:'toggle'},350);

});


});