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
                <h3><i class="fa fa-bars"></i> <?php echo lang_key('Close Auctions'); ?></h3>
                <div class="box-tool">
                    <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                        <form action="<?php echo site_url('admin/auction/auction_pending_ajax_view/0/2'); ?>" method="post" id="table-search-from" class="form-inline pull-right">
                            <div class="">
                                <label class="sr-only" for="exampleInputAmount"><?php echo lang_key('search'); ?>:</label>
                                <div class="input-group">
                                    <input type="text" name="key" class="form-control" id="key" placeholder="<?php echo lang_key('title_city_category'); ?>">
                                    <div class="input-group-addon search-plain" style="cursor:pointer;border-radius:0 5px 5px 0"><i class="fa fa-search"></i></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                        <img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:20px;margin:5px;display:none" class="loading pull-right">
                    </div>
                </div>
                <div id="no-more-tables" class="table-responsive" style="border:0">

                </div>
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
            $('#table-search-from').attr('action', '<?php echo site_url(); ?>admin/auction/auction_pending_ajax_view/' + start + '/' + 2);
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