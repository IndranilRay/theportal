/**
 * Created by Neal on 5/22/2018.
 */
$(document).ready(function(){
    // show list of articles on first load
    showArticles();
});

function showArticles(){
    $.getJSON("http://localhost/PortalAccessManagement/api/articles/read.php", function (data) {

        // html for listing products
        var read_articles_html="";

        // when clicked, it will load the create product form
        read_articles_html+="<div id='create-article' class='btn btn-primary pull-right m-b-15px create-article-button'>";
        read_articles_html+="<span class='glyphicon glyphicon-plus'></span> Create Article";
        read_articles_html+="</div>";

        // start table
        read_articles_html+="<table class='table table-bordered table-hover'>";

        // creating our table heading
        read_articles_html+="<tr>";
        read_articles_html+="<th class='w-25-pct'>Article Title</th>";
        read_articles_html+="<th class='w-10-pct'>Artice Author</th>";
        read_articles_html+="<th class='w-15-pct'>Article Text</th>";
        read_articles_html+="<th class='w-15-pct'>Article Topic</th>";
        read_articles_html+="<th class='w-25-pct text-align-center'>Action</th>";
        read_articles_html+="</tr>";

        // loop through returned list of data
        $.each(data.records, function(key, val) {

            // creating new table row per record
            read_articles_html+="<tr>";

            read_articles_html+="<td>" + val.article_title + "</td>";
            read_articles_html+="<td>" + val.article_author + "</td>";
            read_articles_html+="<td>" + val.article_text + "</td>";
            read_articles_html+="<td>" + val.topic + "</td>";

            // 'action' buttons
            read_articles_html+="<td>";
            // read one product button
            read_articles_html+="<button class='btn btn-primary m-r-10px read-one-article-button' data-id='" + val.article_id + "'>";
            read_articles_html+="<span class='glyphicon glyphicon-eye-open'></span> Read";
            read_articles_html+="</button>";


            // delete button
            read_articles_html+="<button class='btn btn-danger delete-article-button' data-id='" + val.article_id + "'>";
            read_articles_html+="<span class='glyphicon glyphicon-remove'></span> Delete";
            read_articles_html+="</button>";
            read_articles_html+="</td>";

            read_articles_html+="</tr>";

        });
        // end table
        read_articles_html+="</table>";
        $("#page-content").html(read_articles_html);

        // chage page title
        changePageTitle("Read Articles");


    });
}

// when a read article method is clicked
$(document).on('click','.read-articles-button', function(){
    showArticles();
})
