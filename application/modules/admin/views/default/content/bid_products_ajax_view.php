<link href="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.css" rel="stylesheet">
<?php
$curr_page = $this->uri->segment(5);
if ($curr_page == '')
    $curr_page = 0;
$dl = default_lang();
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> <?php echo lang_key('Purchase History'); ?></h3>
                <div class="box-tool">
                    <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('msg'); ?>

                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Delivery Status</th>
                            <th>Payment Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>02356</td>
                            <td>07/05/2024</td>
                            <td>35000</td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td><a href="#" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#table-search-from').submit(function(e) {
            e.preventDefault();
            jQuery('.loading').show();
            var load_url = jQuery(this).attr('action');
            jQuery.post(
                load_url, {
                    key: $('#key').val()
                },
                function(responseText) {
                    jQuery('.loading').hide();
                    jQuery('#no-more-tables').html(responseText);
                    initPaging();
                }
            );
        });
        $('.search-plain').click(function() {
            var start = '<?php echo ($this->uri->segment("5") != "") ? $this->uri->segment("5") : 0; ?>';
            $('#table-search-from').attr('action', '<?php echo site_url(); ?>admin/auction/bid_products_ajax_view/' + start + '/' + 0);
            // var action_url = $('#table-search-from').attr('action');
            // alert(action_url+' '+start);
            $('#table-search-from').submit();
        }).click();
        initPaging();
    });

    function initPaging() {
        //jQuery('#all-posts').dataTable();
        var page_num = "<?php echo $curr_page ?>";
        $("#all-posts").on('click', '.renew-featured', function() {
            var post_id = jQuery(this).data("postid");
            var action = "<?php echo site_url('admin/content/renewfeatured'); ?>" + '/' + page_num + '/' + post_id + '/';
            jQuery('#modal_form').attr("action", action);
            jQuery('#modal_post_id').attr("value", post_id);
            jQuery('#featuredModal').modal('show');
        });
        $("#all-posts").on('click', '.make-featured', function() {
            //alert('clicked');
            var post_id = jQuery(this).data("postid");
            var action = "<?php echo site_url('admin/content/featurepost'); ?>" + '/' + page_num + '/' + post_id + '/';
            jQuery('#modal_form').attr("action", action);
            jQuery('#modal_post_id').attr("value", post_id);
            jQuery('#featuredModal').modal('show');
        });
        $('.pagination a').click(function(e) {
            // e.preventDefault();
            // var load_url = jQuery(this).attr('href');
            // if(load_url!='#')
            // {
            //   $('#table-search-from').attr('action',load_url);
            //   $('#table-search-from').submit();      
            // }
        });
    }
</script>