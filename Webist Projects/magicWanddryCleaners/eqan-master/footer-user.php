<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php if(is_user_logged_in() ){ ?>
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a target="_blank" href="http://eqan.uk">EQAN</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->
<?php } ?>


<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/dist/js/adminlte.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/user/admin-files/dist/js/demo.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    // Date table
    $('#example1').DataTable({
      'ordering'    : false,
      "pageLength": 100,
      "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]]
    });

    $('#example2').DataTable({
      "pageLength": 100,
      "aaSorting": [],
    });

    //Date picker
    $('#datepicker, #datepicker1, #datepicker2').datepicker({
      autoclose: true
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    $(".scroll").click(function(event){
       var wd = $(window).width();
       var gethash = $(this).attr('href');
       if ( gethash.indexOf('#') > -1 ) {
         event.preventDefault();
       var dest=0;
       if($(this.hash).offset().top > $(document).height()-$(window).height()){
          dest=$(document).height()-$(window).height();
       }else{
           
          dest=$(this.hash).offset().top-10; 
           
       }
       //go to destination
       $('html,body').animate({scrollTop:dest}, 1000,'swing');
      }
     });

  });
</script>
<?php wp_footer(); ?>

</body>
</html>