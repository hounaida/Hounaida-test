'use strict';
$( document ).ready(function() {

    $('select').change(function () {
        $("tr:has(td)").remove();
        $.ajax({
            url: Routing.generate('search_product', {'idCategory': $('#categories').val() }),
            success: function (data) {
                var htmlCode ;
                $.each(JSON.parse(data), function(i, item) {
                    htmlCode = '<td>' + item["product_name"] + '</td><td>'
                        + item["base_price"] + '</td><td>' +
                        item["brand"] + '</td><td>' +
                        item["product_material"] + '</td><td>' +
                        item["image_url"] + '</td><td>' +
                        getInputDate(item["delivery"]) + '</td><td>' +
                        item["details"] + '</td><td>' +
                        item["category"]["name"] + '</td>';
                    if ( item["reviews"].length > 0){
                        var routeURL = Routing.generate('reviews_by_product', {'idProduct': item['id'] });
                        htmlCode += '<td><a href="'+ routeURL +'" target="_blank">'
                            +' <img src="'+TWIG.imgDetails+'" width="30" height="40"></a></td>';
                    }
                    $('<tr>').html(htmlCode).appendTo('#products');
                });
            }
        });
    })
    function getInputDate(dateInput) {
        dateInput = new Date(dateInput);
        var month = dateInput.getMonth()+1;
        if( month < 9){
            month = "0" + month;
        }
        var day = dateInput.getDate();
        if( day < 9){
            day = "0" + day;
        }
        dateInput = dateInput.getFullYear() + "-" + month + "-" + day;
        return dateInput;
    }

});