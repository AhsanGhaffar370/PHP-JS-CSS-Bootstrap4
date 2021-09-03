<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Populate City Dropdown Using jQuery Ajax</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select.country").change(function(){
        var selectedCountry = $(".country option:selected").val();
        $.ajax({
            type: "POST",
            url: "file2.php",
            data: { country : selectedCountry } 
        }).done(function(data){
            $("#response").html(data);
        });
    });
});
</script>
</head>
<body>
<form>
    <table>
        <tr>
            <td>
                <label>Country:</label>
                <select class="country">
                    <option>Select</option>
                    <option value="usa">United States</option>
                    <option value="india">India</option>
                    <option value="uk">United Kingdom</option>
                </select>
            </td>
            <td id="response">
                <!--Response will be inserted here-->
            </td>
        </tr>
    </table>
</form>


</body> 
</html>