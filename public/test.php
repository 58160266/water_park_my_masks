<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $.get("https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/api/v1/waterparks", function(data, status){
            alert("Data: " + data.result["0"].wp_detail + "\nStatus: " + status);
            console.log(data);
        });
    });
});
</script>
</head>
<body>

<button>Send an HTTP GET request to a page and get the result back</button>

</body>
</html>
