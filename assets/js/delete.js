
        $(".remove").click(function () {
        var id = $(this).parents("tr").attr("id");
        if (confirm('Are you sure to remove this record ?'))
        {
                            window.location = "../model/delete.php?delete=1&id="+id+"";  

        }
        });


    

