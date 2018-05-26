/**
 * Created by ABC on 5/26/2018.
 */
$(document).ready(function(){

    // show list of topics on first load
    showTopics();

    // when a 'read topics' button was clicked
    $(document).on('click', '.read-topics-button', function(){
        showTopics();
    });

    function showTopics(){
        // get list of products from the API
        $.getJSON("http://localhost/PortalAccessManagement/api/topics/read.php", function(data){

            // html for listing products
            var read_topics_html="";

            // when clicked, it will load the create product form
            read_topics_html+="<div id='create-topics' class='btn btn-primary pull-right m-b-15px create-topics-button'>";
            read_topics_html+="<span class='glyphicon glyphicon-plus'></span> Create Topic";
            read_topics_html+="</div>";

            // start table
            read_topics_html+="<table class='table table-bordered table-hover'>";

            // creating our table heading
            read_topics_html+="<tr>";
            read_topics_html+="<th class='w-25-pct'>Topic Title</th>";
            read_topics_html+="<th class='w-25-pct text-align-center'>Action</th>";
            read_topics_html+="</tr>";

            // loop through returned list of data
            $.each(data.records, function(key, val) {

                // creating new table row per record
                read_topics_html+="<tr>";

                read_topics_html+="<td>" + val.title + "</td>";

                // 'action' buttons
                read_topics_html+="<td>";
                // read one product button
                read_topics_html+="<button class='btn btn-primary m-r-10px read-one-product-button' data-id='" + val.id + "'>";
                read_topics_html+="<span class='glyphicon glyphicon-eye-open'></span> Read";
                read_topics_html+="</button>";

                // edit button
                read_topics_html+="<button class='btn btn-info m-r-10px update-product-button' data-id='" + val.id + "'>";
                read_topics_html+="<span class='glyphicon glyphicon-edit'></span> Edit";
                read_topics_html+="</button>";

                // delete button
                read_topics_html+="<button class='btn btn-danger delete-product-button' data-id='" + val.id + "'>";
                read_topics_html+="<span class='glyphicon glyphicon-remove'></span> Delete";
                read_topics_html+="</button>";
                read_topics_html+="</td>";

                read_topics_html+="</tr>";

            });

            // end table
            read_topics_html+="</table>";
            // inject to 'page-content' of our app
            $("#page-content").html(read_topics_html);
        });
        // chage page title
        changePageTitle("Read Topics");
    }

});

// showProducts() method will be here
