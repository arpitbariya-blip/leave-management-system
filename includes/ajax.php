 <html>
<body>
<form method="post" action="" id="a1">
                    
                           <input type="date"  name="Date"  style="float: right" 
                           value="" maxlength="10" id="Date"  placeholder="Date">
                           <label >Leave Date:</label>
                        
                        <script type="text/javascript" src="js/jquery.js"></script>
                        <script>
    $(document).ready(function() {
    $('#Date').change(function() {
        var date = $(this).val();
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            data: {date: date},
            success: function(data) {
                $('#a1').load(data);
            }
         });
    });
});
    </script>
                    
</form>
</body>
</html>