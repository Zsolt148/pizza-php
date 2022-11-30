function category()
{
    $.post(
        "orders.index",
        {"op" : "category"},
        function(data)
        {
            $("#categorySelect").html('<option value="0">Select...</option>');
            var list = data.list;
            for(i=0; i<list.length; i++)
            {
                $("#categorySelect").append('<option value="'+list[i].name+'">'+list[i].name+'</option>');
            }
        },
        "json"
    );
}

function pizza()
{
    $("#pizzaSelect").html("");
    $("#orderedSelect").html("");
    $(".data").html("");
    var categoryName = $("#categorySelect").val();
    if (categoryName != "")
    {
        $.post(
            "orders.index",
            {"op" : "pizza", "catName" : categoryName},
            function(data)
            {
                $("#pizzaSelect").html('<option value="0">Select...</option>');
                var list = data.list;
                for(i=0; i<list.length; i++)
                {
                    $("#pizzaSelect").append('<option value="'+list[i].name+'">'+list[i].name+'</option>');
                }
            },
            "json"
        );
    }
}

function ordered()
{
    $("#orderedSelect").html("");
    $(".data").html("");
    var pizzaName = $("#pizzaSelect").val();
    if (pizzaName != "")
    {
        $.post(
            "orders.index",
            {"op" : "ordered", "pizName" : pizzaName},
            function(data)
            {
                $("#orderedSelect").html('<option value="0">Select...</option>');
                var list = data.list;
                for(i=0; i<list.length; i++)
                {
                    $("#orderedSelect").append('<option value="'+list[i].id+'">'+list[i].ordered+'</option>');
                }
            },
            "json"
        );
    }
}

function order()
{
    $(".data").html("");
    var orderID = $("#orderedSelect").val();
    if (orderID != 0)
    {
        $.post(
            "orders.index",
            {"op" : "info", "id" : orderID},
            function(data) {
                $("#name").text(data.name);
                $("#price").text(data.price);
                $("#amount").text(data.amount);
                $("#ordered_at").text(data.ordered_at);
                $("#delivery_at").text(data.delivery_at);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function()
{
    category();
    
    $("#categorySelect").change(pizza);
    $("#pizzaSelect").change(ordered);
    $("#orderedSelect").change(order);
});