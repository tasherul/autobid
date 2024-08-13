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
                <h3><i class="fa fa-bars"></i> <?php echo lang_key('Bidded Products'); ?></h3>
                <div class="box-tool">
                    <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content" style="overflow: hidden;">
                <?php echo $this->session->flashdata('msg'); ?>

                <table id="bidTable" class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>My Bid</th>
                            <th>Highest Bid</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($bids)) {
                            foreach ($bids as $bid) {
                                $highest_bid = $this->db->order_by('amount', 'DESC')->get_where('bid', ['car_id' => $bid->car_id])->row();
                        ?>
                                <tr>
                                    <td><?= get_post_data_by_lang($bid, 'title') ?></td>
                                    <td><?= $bid->amount ?></td>
                                    <td><?= !empty($highest_bid) && isset($highest_bid->amount) ? $highest_bid->amount : 0 ?></td>
                                    <td><?= !empty($bid->end_time) ? date('d/m/Y h:i:s A', strtotime($bid->end_time)) : '' ?></td>
                                    <td>
                                        <?php
                                        if ($bid->auction_status != 2) { ?>
                                            <a href="javascript:void(0);" id="editBid" class="btn btn-info" onclick="editBid(<?= $bid->bid_id ?>, '<?= $bid->amount ?>')"><i class="fa fa-edit"></i></a>
                                        <?php }
                                        ?>
                                    </td>
                                </tr>
                        <?php }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bidModal" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/auction/edit_bid') ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Bid</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <input type="hidden" id="bid_id" name="bid_id">
                    <label for="">Amount</label>
                    <input type="number" class="form-control" id="bid_amount" name="amount">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
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

<script>
    $(document).ready(function() {
        $('#bidTable').DataTable({
            layout: {
                topStart: {
                    searchPanes: {
                        // config options here
                    }
                }
            }
        });
    });


    function editBid(bid_id, amount) {
        $("#bidModal form").trigger('reset');
        $("#bidModal").modal('show');
        $('#bid_amount').val(amount);
        $('#bid_id').val(bid_id);
    }
</script>