<html>
<head>
<TITLE>jQuery Progress bar for PHP AJAX File Upload</TITLE>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
<style>
#uploadForm label {
    margin: 2px;
    font-size: 1em;
}

#progress-bar {
    background-color: #12CC1A;
    color: #FFFFFF;
    width: 0%;
    -webkit-transition: width .3s;
    -moz-transition: width .3s;
    transition: width .3s;
    border-radius: 5px;
}

#targetLayer {
    width: 100%;
    text-align: center;
}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
    integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
$(document).ready(function() {
     $('#uploadForm').submit(function(e) {
        if($('#userImage').val()) {
            e.preventDefault();
            $('#loader-icon').show();
            $(this).ajaxSubmit({
                target:   '#targetLayer',
                beforeSubmit: function() {
                  $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status" class="text-center">' + percentComplete +' %</div>')
                },
                success:function (){
                    $('#loader-icon').hide();
                },
                resetForm: true
            });
            return false;
        }
    });
});

</script>
</head>
<body>
    <div class="phppot-container tile-container">
        <form id="uploadForm" action="upload.php" method="post">

            <h2 class="text-center">Progress Bar</h2>
            <div>
                <div class="row">
                    <label>Upload Image File:</label> <input
                        name="userImage" id="userImage" type="file"
                        accept="image/*" class="full-width" required>
                </div>
                <div class="row">
                    <input type="submit" value="Submit"
                        class="full-width" />
                </div>
                <div class="row">
                    <div id="progress-bar"></div>
                </div>
                <div id="targetLayer"></div>
            </div>
        </form>
        <div id="loader-icon" style="display: none;">
            <img src="LoaderIcon.gif" />
        </div>
    </div>
</body>
</html>