<!-- file updated on version 1.6 -->
<?php
$curr_page = $this->uri->segment(5);
if ($curr_page == '')
    $curr_page = 0;
$dl = default_lang();
?>
<span class="ajax-msg"></span>
<table id="all-posts" class="table table-hover table-advance">

    <thead>

        <tr>

            <th class="numeric serial" style="width:50px;">
                #
            </th>

            <th class="numeric photo"><?php echo lang_key('image'); ?></th>

            <th class="numeric title"><?php echo lang_key('title'); ?></th>

            <th class="numeric category"><?php echo lang_key('category'); ?></th>
            <?php if ($user_type == 1) : ?>
                <th class=""><?php echo lang_key('Asking Bid'); ?></th>
                <th class=""><?php echo lang_key('Min Bid'); ?></th>
            <?php else : ?>
                <th class="numeric email"><?php echo lang_key('Asking Bid'); ?></th>
            <?php endif ?>
            <th class="numeric city"><?php echo lang_key('Start Time'); ?></th>
            <th class="numeric featured-status"><?php echo lang_key('End Time'); ?></th>

            <th class="numeric status" style="width: 100px;"><?php echo lang_key('status'); ?></th>

            <!-- <th class="numeric days-left"><?php echo lang_key('days_left'); ?></th> -->
            <th class="numeric actions"><?php echo lang_key('actions'); ?></th>

        </tr>

    </thead>

    <tbody>

        <?php
        //updated on version 1.9
        foreach ($auctions as $row) :  ?>

            <tr>

                <td data-title="#" class="numeric">
                    <?php echo $i; ?>
                </td>

                <td data-title="<?php echo lang_key('image'); ?>" class="numeric"><img class="thumbnail" style="width:50px;margin-bottom:0px;" src="<?php echo get_featured_photo_by_id($row->featured_img); ?>" /></td>

                <td data-title="<?php echo lang_key('title'); ?>" class="numeric"><?php echo get_post_data_by_lang($row, 'title'); ?></td>

                <td data-title="<?php echo lang_key('category'); ?>" class="numeric"><?php echo get_category_title_by_id($row->category); ?></td>
                <?php if ($user_type == 1) : ?>
                    <td data-title="<?php echo lang_key('category'); ?>" class="numeric"><?php echo $row->asking_bid; ?></td>
                    <td data-title="<?php echo lang_key('category'); ?>" class="numeric"><?php echo $row->min_bid; ?></td>
                <?php else : ?>
                    <td data-title="<?php echo lang_key('category'); ?>" class="numeric"><?php echo $row->min_bid; ?></td>
                <?php endif ?>


                <td data-title="<?php echo lang_key('Start Time'); ?>" class="numeric"><?php echo date('d M Y h:i:s A', strtotime($row->start_time)) ?></td>
                <td data-title="<?php echo lang_key('End Time'); ?>" class="numeric"><?php echo date('d M Y h:i:s A', strtotime($row->end_time)) ?></td>

                <td data-title="<?php echo lang_key('status'); ?>" class="numeric">
                    <?php
                    if ($user_type == 1) { ?>
                        <select onchange="change_auction_status(<?= $row->auction_id ?>, this.value)" name="auction_status" id="auction_status" class="bg-light">
                            <option value="0" <?= $row->auction_status == '0' ? 'selected' : '' ?>>Pending</option>
                            <option value="1" <?= $row->auction_status == '1' ? 'selected' : '' ?>>Approved</option>
                            <option value="2" <?= $row->auction_status == '2' ? 'selected' : '' ?>>Close</option>
                        </select>
                    <?php } else {
                        if ($row->auction_status == 0) {
                            echo '<div class="badge badge-warning">Pending</div>';
                        } else if ($row->auction_status == 1) {
                            echo '<div class="badge badge-success">Approved</div>';
                        } else {
                            echo '<div class="badge badge-danger">Closed</div>';
                        }
                    }
                    ?>

                </td>

                <!-- <td data-title="<?php echo lang_key('days_left'); ?>" class="numeric">
                    <?php


                    // $future = strtotime($row->end_time); //Future date.
                    // $timefromdb = time();
                    // // $timefromdb = $row->start_time;
                    // $timeleft = $future - $timefromdb;
                    // $daysleft = ceil((($timeleft / 24) / 60) / 60);
                    // if ($daysleft < 0)
                    //     echo '--';
                    // else
                    //     echo $daysleft . ' ' . lang_key('days');

                    ?>
                </td> -->
                <td data-title="<?php echo lang_key('actions'); ?>" class="numeric">
                    <?php if ($row->auction_status == 0 || $user_type == 1) : ?>
                        <div class="btn-group">
                            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <?php echo lang_key('action'); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-info">
                                <li><a href="<?php echo site_url('admin/auction/auction_add/' . $row->auction_id) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo lang_key('edit'); ?></a></li>
                            </ul>
                        </div>
                    <?php endif ?>
                </td>
            </tr>

        <?php $i++;
        endforeach; ?>

    </tbody>

</table>

<div class="pagination pull-right">
    <ul class="pagination pagination-colory"><?php echo (isset($pages)) ? $pages : ''; ?></ul>
</div>
<div class="pull-right">
    <img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:20px;margin:5px;display:none" class="loading">
</div>
<div class="clearfix"></div>
<a href="#" class="btn btn-danger delete-all" style="display:none"><?php echo lang_key('delete_selected'); ?></a>
<div class="clearfix"></div>


<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.check-all-ids').click(function(e) {
            var checked = jQuery(this).attr('checked');
            if (checked == 'checked') {
                jQuery('.ids').prop('checked', true);
                jQuery('.delete-all').show();
            } else {
                jQuery('.ids').prop('checked', false);
                jQuery('.delete-all').hide();
            }
        });

        jQuery('.ids').click(function(e) {
            var checked = jQuery(this).attr('checked');
            if (checked != 'checked') {
                jQuery('.check-all-ids').prop('checked', false);
                var flag = 0;
                jQuery('.ids').each(function() {
                    if (jQuery(this).attr('checked') == 'checked')
                        flag = 1;
                });
                if (flag == 0)
                    jQuery('.delete-all').hide();
            } else {
                jQuery('.delete-all').show();
            }
        });

        jQuery('.delete-all').click(function(e) {
            e.preventDefault();
            var r = confirm("<?php echo lang_key('delete_warning'); ?>");
            if (r == true) {
                var load_url = '<?php echo site_url("admin/content/bluk_delete_ads/") ?>';
                var id_array = Array();

                jQuery('.ids').each(function() {
                    if (jQuery(this).attr('checked') == 'checked')
                        id_array.push(jQuery(this).val());
                });

                jQuery.post(
                    load_url, {
                        ids: id_array
                    },
                    function(responseText) {
                        $('#table-search-from').submit();
                    }
                );
            }

        });

    });
</script>


<script>
    function change_auction_status(auction_id, auction_status) {

        $.ajax({
            type: "post",
            url: "<?= site_url('admin/auction/change_auction_status/') ?>",
            data: {
                auction_id: auction_id,
                auction_status: auction_status
            },
            dataType: "json",
            success: function(response) {
                window.location.href = response;
            }
        });
    }
</script>