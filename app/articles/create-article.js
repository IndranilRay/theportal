/**
 * Created by Neal on 5/22/2018.
 */
$(document).ready(function(){

    // show html form when 'create article' button was clicked
    $(document).on('click', '.create-article-button', function(){
        // load list of topics
        $.getJSON("http://localhost/PortalAccessManagement/api/topics/read.php", function(data){
            // build topics option html
            // loop through returned list of data
            var topics_options_html="";
            topics_options_html+="<select name='topic_id' class='form-control'>";
            $.each(data.records, function(key, val){
                topics_options_html+="<option value='" + val.id + "'>" + val.title + "</option>";
            });
            topics_options_html+="</select>";
            // we have our html form here where product information will be entered
            // we used the 'required' html5 property to prevent empty fields
            var create_article_html="";

            // 'read articles' button to show list of products
            create_article_html+="<div id='read-articles' class='btn btn-primary pull-right m-b-15px read-articles-button'>";
            create_article_html+="<span class='glyphicon glyphicon-list'></span> Read articles";
            create_article_html+="</div>";

            // 'create product' html form
            create_article_html+="<form id='create-article-form' action='#' method='post' border='0'>";
            create_article_html+="<table class='table table-hover table-responsive table-bordered'>";

            // Article Title field
            create_article_html+="<tr>";
            create_article_html+="<td>Article Title</td>";
            create_article_html+="<td><input type='text' name='article_title' class='form-control' required /></td>";
            create_article_html+="</tr>";

            // Article author field
            create_article_html+="<tr>";
            create_article_html+="<td>Author</td>";
            create_article_html+="<td><input type='text' name='article_author' class='form-control' required /></td>";
            create_article_html+="</tr>";

            // Article Content field
            create_article_html+="<tr>";
            create_article_html+="<td>Content</td>";
            create_article_html+="<td><textarea name='article_text' class='form-control' required></textarea></td>";
            create_article_html+="</tr>";

            // Article topics 'select' field
            create_article_html+="<tr>";
            create_article_html+="<td>Select Topic</td>";
            create_article_html+="<td>" + topics_options_html + "</td>";
            create_article_html+="</tr>";

            // button to submit form
            create_article_html+="<tr>";
            create_article_html+="<td></td>";
            create_article_html+="<td>";
            create_article_html+="<button type='submit' class='btn btn-primary'>";
            create_article_html+="<span class='glyphicon glyphicon-plus'></span> Create Article";
            create_article_html+="</button>";
            create_article_html+="</td>";
            create_article_html+="</tr>";

            create_article_html+="</table>";
            create_article_html+="</form>";

            // inject html to 'page-content' of our app
            $("#page-content").html(create_article_html);

            // chage page title
            changePageTitle("Create Article");

        });
    });

    // 'create article form' handle will be here
    $(document).on('submit', '#create-article-form', function(){
        // get form data
        var form_data=JSON.stringify($(this).serializeObject());

        // submit form data to api
        $.ajax({
            url: "http://localhost/PortalAccessManagement/api/articles/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                // product was created, go back to article list
                showArticles();
            },
            error: function(xhr, resp, text) {
                // show error to console
                console.log(xhr, resp, text);
            }
        });
        return false;
    });

});

