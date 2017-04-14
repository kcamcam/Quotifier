/*---- Update your footer ----*/
function setYear(){
    var footer = document.getElementById("yearFooter");
    var date = new Date();
    date = date.getYear().toString();
    date = "20"+ date.substring(1,3);
    footer.innerHTML=date;
}
/* Genereate a Random Quote */
function genquote(){
    var codebox = document.getElementById("quote");
    var smajsonQuotes = db['quotes'];
    var smajsonAuthors = db['authors'];
    var x = Math.floor((Math.random()*smajsonQuotes.length)+0);
    var y = Math.floor((Math.random()*smajsonAuthors.length)+0);
    var ghandi = "//\""+smajsonQuotes[x]+"\" - "+smajsonAuthors[y];
    codebox.innerHTML += "<code>"+ghandi+"</code><br/><br/>";
}

/*File Upload Button */
$('#file-upload').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
});
/* Check if file is uploaded */
$(document).ready(
    function() {
        $('input:file').change(
            function () {
                if ($(this).val()) {
                    $('input:submit').attr('disabled', false);
                    // or, as has been pointed out elsewhere:
                    // $('input:submit').removeAttr('disabled');
                }
            }
        );
    }
);

/*---- Google Analytics ----*/
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-96559566-1', 'auto');
ga('send', 'pageview');
