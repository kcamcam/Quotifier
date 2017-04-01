<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--META DATA -->
    <title>Quotifier</title>
    <link rel="icon" type="image/png" href="doublequotes.png"/>
    <meta name="author" content="Kevin Camellini">
    <meta name="description" content="Comment your code with random quotes.">
    <meta name="keywords" content="comments, quotes, code, github, bootstrap, software, develoeper, gandhi">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/e0af25fb51.js"></script>
    <!-- Custom Style Sheet -->
    <link href="css/style2.css" rel="stylesheet" type="text/css">
</head>
<body onload="setYear()">
    <!-- Body -->
    <div class="landing">
        <div class="container-fluid">
            <div class="row-fluid">
<?php
    /* ----- QUOTIFIER VARIABLES ------ */
    $jsonfile = file_get_contents("db.json");
    $jsonshiz = json_decode($jsonfile, true);
    $authors = $jsonshiz['authors'];
    $quotes = $jsonshiz['quotes'];
    $ext = $jsonshiz['fileext'];

    /* ----- FILE VARIABLES ------ */
    $submitvalue = $_POST['submit'];
    $temp = $_FILES['fileToUpload']['tmp_name'];
    $size = $_FILES['fileToUpload']['size'];
    $name = $_FILES['fileToUpload']['name'];
    $contents = file_get_contents($temp);
    $upext = pathinfo($name, PATHINFO_EXTENSION);
    $myfile = "input.txt";
    $uploadOk =1;

    if($_POST['submit']){

        /*------ Limit file upload size ------ */
        echo "<h1>&#8220 Quotifer &#8221</h1>";
        if ($size > 500000 || $size==0) {
            echo "<h4>Your file must be < 500 kb:</h4>
                    <ul><li>Quit tryna h4x us.</li></ul>";
        }

        /*------ Allow only certain file formats ------ */
        $extensionexists = false;
        foreach($ext as $key => $value) {
            if ($key == $upext)
                $extensionexists = true;
        }
        if (!$extensionexists){
            echo "<h4>Only the following formats are supported:</h4>				
                    <ul>
                        <li>.rb</li>
                        <li>.java</li>
                        <li>.py</li>
                        <li>.cpp</li>
                        <li>.tex</li>
                        <li>.js</li>
                        <li>.o</li>
                        <li>.swift</li>
                        <li>.json</li>
                        <li>.php</li>
                    </ul>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "
                <h4>Your file was not uploaded..</h4>
                <a type=\"button\" class=\"btn btn-warning \" href=\"http://quotifier.ca\">
                    <span class=\"glyphicon glyphicon-triangle-left\" aria-hidden=\"true\"></span> Back
                </a>";
        }
        // if everything is ok, quotify the file
        else if ($submitvalue == "Quotify")
                quotify($myfile);
        // if everything is ok, boringify the file
        else if ($submitvalue == "Boringify")
                boringify($myfile);
    }else{
        header("Location: index.html");
    }

    /* ----- QUOTIFIER AWESOMENESS METHODS ------ */
    // Genreate a random quote with a random author
    function genquote(){
        global $authors, $quotes;
        $rand_quote = rand(0, sizeof($quotes)-1);
        $rand_author = rand(0, sizeof($authors)-1);
        return '"'.$quotes[$rand_quote].'" - '.$authors[$rand_author];
    }
                
    // Spice up the files mojo with some quotes
    function quotify($filename){
        global $temp,$ext,$upext,$name;
        $openfile = fopen($filename, "w+") or die("Unable to open file..");
        $opentemp = fopen($temp, "r") or die("Unable to open file..");
        $fullfile = "";
        $counter = 0;

        while(!feof($opentemp)) {
            $line = fgets($opentemp);
            $counter++;
            $fullfile = $fullfile."".$line;
            $random = rand(5,15);
            if( fmod($counter,$random)  == 0)
                $fullfile = $fullfile.$ext[$upext].genquote()."\n";
        }
        echo "<h4>Your New(better) File: </h4>";
        echo "<a type=\"button\" class=\"btn btn-info fileinput-button\" href=\"input.txt\" download=$name>
                    <span class=\"glyphicon glyphicon-download-alt\" aria-hidden=\"true\"></span> Download Commented File
                </a>
                <br/><br/>
                <pre>";
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $fullfile) as $l){
            echo "</code>".$l."</code><br/>";
        }

        echo "</pre>
                <a type=\"button\" class=\"btn btn-warning\" href=\"http://quotifier.ca\">
                    <span class=\"glyphicon glyphicon-triangle-left\"></span> Back
                </a>";
        fwrite($openfile,$fullfile);
        fclose($openfile);
        fclose($opentemp);
    }

    // Make the file hella boring by removing quotes
    function boringify($filename){
        global $temp,$ext,$upext,$name;
        $openfile = fopen($filename, "w+") or die("Unable to open file..");
        $opentemp = fopen($temp, "r") or die("Unable to open file..");
        $fullfile = "";
        while(!feof($opentemp)) {
            $line = fgets($opentemp);
            if((substr($line,0,2) != ($ext[$upext]."\"")) && (substr($line,0,3) != ($ext[$upext]."\"")))
                $fullfile = $fullfile."".$line;
        }
        echo "<h4>Your New(boring) File: </h4>";
        echo "<a type=\"button\" class=\"btn btn-info fileinput-button\" href='input.txt' download=$name>
                    <span class=\"glyphicon glyphicon-download-alt\"></span> Download Commented File
                </a>
                <br/><br/>
                <pre>";
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $fullfile) as $l){
            echo "</code>".$l."</code><br/>";
        }

        echo "</pre>
                <a type=\"button\" class=\"btn btn-warning\" href=\"http://quotifier.ca\">
                    <span class=\"glyphicon glyphicon-triangle-left\"></span> Back
                </a>";
        fwrite($openfile,$fullfile);
        fclose($openfile);
        fclose($opentemp);
    }

    /* ----- DEBUGGER ------ */
    function debugger( $data ){
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer text-center">
        <div class="container-fluid">
            <div class="row-fluid social">
                <a href="https://twitter.com/famingolabs" target="_blank">
                    <span class="fa fa-twitter"></span>
                </a>
                <a href="mailto:hello@famingolabs.com?Subject=Quotifier%20app">
                    <span class="fa fa-envelope-o"></span>
                </a>
            </div>
            <div class="row-fluid famingo">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0 0;">
                    <p class="text-muted"><a href="https://www.famingolabs.com" target="_blank">&copy; <span id="yearFooter"></span> Famingo Labs Inc.</a> All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery JavaScript -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <!-- Custom Scripts -->
    <script type="text/javascript" src="script/script.js"></script>
</body>
</html>
