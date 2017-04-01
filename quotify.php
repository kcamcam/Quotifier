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

    /* ----- QUOTIFIER AWESOMENESS ------ */
    // Genreate a random quote with a random author
    function genquote(){
        global $authors, $quotes;
        $rand_quote = rand(0, sizeof($quotes)-1);
        $rand_author = rand(0, sizeof($authors)-1);
        return '"'.$quotes[$rand_quote].'" - '.$authors[$rand_author];
    }

    /* ----- CUSTOM FUNCTIONS ----- */

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