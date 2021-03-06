/**
 * Created by Neal on 5/22/2018.
 */
$(document).ready(function(){

    // will run if the delete button was clicked
    $(document).on('click', '.delete-article-button', function(){
        // get the article id
        var article_id = $(this).attr('data-id');

        bootbox.confirm({

            message: "<h4>Are you sure?</h4>",
            buttons: {
                confirm: {
                    label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                    className: 'btn-danger'
                },
                cancel: {
                    label: '<span class="glyphicon glyphicon-remove"></span> No',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                // delete request will be here
                if(result==true){

                    // send delete request to api / remote server
                    $.ajax({
                        url: "http://localhost/theportal/api/articles/delete.php",
                        type : "POST",
                        dataType : 'json',
                        data : JSON.stringify({ id: article_id }),
                        success : function(result) {
                            // re-load list of products
                            showArticles();
                        },
                        error: function(xhr, resp, text) {
                            console.log(xhr, resp, text);
                        }
                    });
                }
            }
        });
    });
});