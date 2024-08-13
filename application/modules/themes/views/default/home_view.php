<?php
if (get_settings('banner_settings', 'show_search_panel', 'Yes') == 'Yes')
    require 'home_custom_search.php';
?>

<!-- Container -->
<div class="container main-container">

    <div class="row">
        <div class="col-12">
            <?php $this->load->view('auction_list') ?>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 content-body">

            <div class="widget-separator"></div>
            <?php render_widgets('home_page'); ?>
        </div>


        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="sidebar">
                <?php require_once 'sidebar.php'; ?>
            </div>
        </div>

    </div>
</div>