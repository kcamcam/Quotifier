<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--META DATA -->
	<title>quotifier.ca</title>
	<link rel="icon" type="image/png" href="doublequotes.png"/>
	<meta name="author" content="Kevin Camellini">
	<meta name="description" content="Comment your code with random quotes.">
    <meta name="keywords" content="comments, fun quotes, code, github, bootstrap, software, develoeper, gandhi">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/e0af25fb51.js"></script>
    <!-- Custom Style Sheet -->
    <link href="css/style4.css" rel="stylesheet" type="text/css">
</head>
<body onload="setYear()">
	<!-- Content -->
	<div class="landing">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-xs-12">
					<!-- Title -->
					<h1>&#8220; Quotifer &#8221;</h1>
					<!-- Description -->
					<p>Because regular comments are too mainstream.</p>
	                <h4>What it does</h4>
	                <p>Quotifier adds random quotes to your code. Using breakthroughs in machine learning and big data, it is able to generate fake quotes. It is also smart enough to know how the comment should be formatted for the uploaded file type.</p>
				</div>
				<div class="col-xs-12">
					<!-- Examples -->
					<h4>This code will produce beautiful gems like:</h4>
					<pre id="quote"><code>//"It's local on the the remote server" - Soulja Boy</code><br/><br/><code>//"Those were alternative facts" - Undertaker</code><br/><br/><code>//"An eye for eye only ends up making the whole world blind." - Oprah Winfrey</code><br/><br/></pre>
					<button class="btn btn-primary" onclick="genquote()">Quote++</button>
	                <!-- File Formats -->
	                <h4>Supported file formats:</h4>
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
						<li>.html</li>
						<li>.css</li>
					</ul>
				</div>
			</div>
            <!-- Buttons -->
			<div class="row-fluid">
				<div class="col-xs-12">
					<form action="quotify.php" method="post" enctype="multipart/form-data" class="myform" id="myform">
            <h4>Select a file to upload:</h4>
            <p>Don't worry, the origial remains untouched.</p>
            <!-- Add File -->
            <label class="btn btn-success fileinput-button" for="file-upload">Add File...</label>
            <input type="file" style="display:none;" name="fileToUpload" id="file-upload">
            <!-- Quotify -->
            <input type="submit" name="submit" class="btn btn-primary start" value="Quotify" disabled>
            <!-- Boringify -->
            <input type="submit" name="submit" class="btn btn-danger start" value="Boringify" disabled>
					</form>
				</div>
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
                    <p class="text-muted"><a href="http://www.famingolabs.com" target="_blank">&copy; <span id="yearFooter"></span> Famingo Labs Inc.</a> All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
	<!-- jQuery JavaScript -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- Custom Scripts -->
	<script type="text/javascript" src="data.json"></script>
	<script type="text/javascript" src="script/script14.js"></script>
</body>
</html>
