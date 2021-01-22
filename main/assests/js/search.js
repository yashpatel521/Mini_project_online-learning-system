$(document).ready(function(e){
    $("#search").keyup(function(){
        $("#show_up").show();
        var text = $(this).val();
        if (text != '')
        {
            $.ajax({
                type: 'GET',
                url: 'ajax/getsearch.php',
                data: 'txt=' + text,
                success: function(data){
                    $("#show_up").html(data);
                }
            });
        }
        else
        {
            $("#show_up").html('');
        }
    })
});