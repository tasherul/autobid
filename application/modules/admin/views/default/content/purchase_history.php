<link href="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.css" rel="stylesheet">
<?php
$curr_page = $this->uri->segment(5);
if ($curr_page == '')
    $curr_page = 0;
$dl = default_lang();
?>
<style>
    .div.dataTables_filter input {
        display: block !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> <?php echo lang_key('Purchase History'); ?></h3>
                <div class="box-tool">
                    <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content" style="overflow: hidden;">
                <?php echo $this->session->flashdata('msg'); ?>

                <table id="bidTable" class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Delivery Status</th>
                            <th>Payment Status</th>
                            <th>Options</th>
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
                                    <td><?= $bid->id ?></td>
                                    <td><?= !empty($bid->purchase_time) ? date('d/m/Y h:i:s A', strtotime($bid->purchase_time)) : '' ?></td>
                                    <td><?= $bid->amount ?></td>
                                    <td>
                                        <?php
                                        if ($user_type == 1) { ?>
                                            <select id="delivery_status" class="form-control" name="delivery_status" onchange="purchase_status_update(<?= $bid->bid_id ?>, 'delivery_status')">
                                                <option value="false" <?= $bid->delivery_status == '0' ? 'selected' : '' ?>>Pending</option>
                                                <option value="true" <?= $bid->delivery_status == '1' ? 'selected' : '' ?>>Delivered</option>
                                            </select>
                                        <?php } else {
                                            if ($bid->delivery_status == 0) {
                                                echo '<span class="badge bagde-warning">Pending</span>';
                                            } else {
                                                echo '<span class="badge bagde-success">Delivered</span>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($user_type == 1) { ?>
                                            <select id="payment_status" class="form-control" name="payment_status" onchange="purchase_status_update(<?= $bid->bid_id ?>, 'payment_status')">
                                                <option value="false" <?= $bid->payment_status == '0' ? 'selected' : '' ?>>Pending</option>
                                                <option value="true" <?= $bid->payment_status == '1' ? 'selected' : '' ?>>Paid</option>
                                            </select>
                                        <?php } else {


                                            if ($bid->payment_status == 0) {
                                                echo '<span class="badge bagde-danger">Pending</span>';
                                            } else {
                                                echo '<span class="badge bagde-info">Paid</span>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td></td>
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
            responsive: true
        });
    });

    function purchase_status_update(id, name) {
        var value = $('#' + name).val();
        var status = 0;
        if (value == 'true') {
            status = 1;
        }

        $.ajax({
            type: "post",
            url: "<?= base_url('admin/auction/purchase_status_update') ?>",
            data: {
                id: id,
                value: status,
                name: name,
            },
            dataType: "json",
            success: function(response) {
                window.location.reload();
            }
        });
    }
</script>