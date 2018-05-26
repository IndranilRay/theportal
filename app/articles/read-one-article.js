/**
 * Created by Neal on 5/22/2018.
 */
$(document).ready(function(){

    // handle 'read one' button click
    $(document).on('click', '.read-one-article-button', function(){

        // get article id
        var id = $(this).attr('data-id');

        // read article record based on given ID
        $.getJSON("http://localhost/PortalAccessManagement/api/articles/read_one.php?id=" + id, function(data){
            // read article button will be here
            // start html
            var read_one_article_html="";

            // when clicked, it will show the product's list
            read_one_article_html+="<div id='read-articles' class='btn btn-primary pull-right m-b-15px read-articles-button'>";
            read_one_article_html+="<span class='glyphicon glyphicon-list'></span> Read Articles";
            read_one_article_html+="</div>";

            // article data will be shown in this table
            read_one_article_html+="<table class='table table-bordered table-hover'>";

            // article title
            read_one_article_html+="<tr>";
            read_one_article_html+="<td class='w-30-pct'>Article Title</td>";
            read_one_article_html+="<td class='w-70-pct'>" + data.article_title + "</td>";
            read_one_article_html+="</tr>";

            // article author
            read_one_article_html+="<tr>";
            read_one_article_html+="<td>Author</td>";
            read_one_article_html+="<td>" + data.article_author + "</td>";
            read_one_article_html+="</tr>";

            // article content
            read_one_article_html+="<tr>";
            read_one_article_html+="<td>Content</td>";
            read_one_article_html+="<td>" + data.article_text + "</td>";
            read_one_article_html+="</tr>";

            // article topic name
            read_one_article_html+="<tr>";
            read_one_article_html+="<td>Article Topic</td>";
            read_one_article_html+="<td>" + data.topic_title + "</td>";
            read_one_article_html+="</tr>";

            read_one_article_html+="</table>";

            // inject html to 'page-content' of our app
            $("#page-content").html(read_one_article_html);

            // chage page title
            changePageTitle("Read One Article");
        });
    });

});
