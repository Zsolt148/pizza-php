function category()
{
    $(document).ready(function () {

        $.ajax({
            url: $("#categorySelect").data('route'),
            data : {"op" : "category"},
            success: function (resp) {
                $("#categorySelect").html('<option value="0">Select...</option>');
                let list = JSON.parse(resp).list;
                for(i=0; i<list.length; i++)
                {
                    $("#categorySelect").append('<option value="'+list[i].name+'">'+list[i].name+'</option>');
                }
            }
        })
    })
}

function pizza()
{
    $("#pizzaSelect").html("");
    $("#orderedSelect").html("");
    $(".data").html("");
    var categoryName = $("#categorySelect").val();
    if (categoryName != "")
    {
        $.ajax({
            url: $("#categorySelect").data('route'),
            data: {"op" : "pizza", "catName" : categoryName},
            success: function(resp) {
                $("#pizzaSelect").html('<option value="0">Select...</option>');
                let list = JSON.parse(resp).list;
                for (i = 0; i < list.length; i++) {
                    $("#pizzaSelect").append('<option value="' + list[i].name + '">' + list[i].name + '</option>');
                }
            }
        });
    }
}

function ordered()
{
    $("#orderedSelect").html("");
    $(".data").html("");
    var pizzaName = $("#pizzaSelect").val();
    if (pizzaName != "")
    {
        $.ajax({
            url: $("#categorySelect").data('route'),
            data:  {"op" : "ordered", "pizzaName" : pizzaName},
            success: function(resp) {
                $("#orderedSelect").html('<option value="0">Select...</option>');
                let list = JSON.parse(resp).list;
                for(i=0; i<list.length; i++)
                {
                    $("#orderedSelect").append('<option value="'+list[i].id+'">'+list[i].ordered+'</option>');
                }
            }
        });
    }
}

function order()
{
    $(".data").html("");
    var orderID = $("#orderedSelect").val();
    if (orderID != 0)
    {
        $.ajax({
            url: $("#categorySelect").data('route'),
            data:  {"op" : "info", "id" : orderID},
            success: function(resp) {
                let list = JSON.parse(resp);
                $("#name").text(list.name);
                $("#price").text(list.price);
                $("#amount").text(list.amount);
                $("#ordered_at").text(list.ordered_at);
                $("#delivery_at").text(list.delivery_at);
            }
        });
    }
}

$(document).ready(function()
{
    category();
    
    $("#categorySelect").change(pizza);
    $("#pizzaSelect").change(ordered);
    $("#orderedSelect").change(order);
});