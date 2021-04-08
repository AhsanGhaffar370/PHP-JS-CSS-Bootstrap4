<form id="frmContactUs">
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" required/></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" required/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" id="submit" name="submit"/></td>
        </tr>
    </table>
    <div id="result_msg">

    </div>
</form>
<style>
#frmContactUs table td{border:0px;}
#frmContactUs .false{color:red;}    
#frmContactUs .true{color:green;}    
</style>
<script>
jQuery('#frmContactUs').submit(function(){
    event.preventDefault();
    jQuery('#result_msg').html('');
    var link="<?php echo admin_url('admin-ajax.php')?>";
    var form=jQuery('#frmContactUs').serialize();
    var formData=new FormData;
    formData.append('action','contact_us');
    formData.append('contact_us',form);
    jQuery('#submit').attr('disabled',true);
    jQuery.ajax({
        url:link,
        data:formData,
        processData:false,
        contentType:false,
        type:'post',
        success:function(result){
            jQuery('#submit').attr('disabled',false);
            if(result.success==true){
                jQuery('#frmContactUs')[0].reset();
            }
            jQuery('#result_msg').html('<span class="'+result.success+'">'+result.data+'</span>')    
            //result.success
            //result.data
        }
    });
});    
</script>