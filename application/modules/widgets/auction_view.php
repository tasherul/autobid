<style>
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .video__icon {
        position: absolute;
        width: 50px;
        left: 10%;
        top: -30px;
    }

    .video__icon .circle--outer {
        border: 1px solid #e50040;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin: 0 auto 5px;
        position: relative;
        opacity: .8;
        -webkit-animation: circle 2s ease-in-out infinite;
        animation: circle 2s ease-in-out infinite;
    }

    .video__icon .circle--inner {
        background: #e50040;
        left: 15px;
        top: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: absolute;
        opacity: .8;
    }

    .video__icon .circle--inner:after {
        content: '';
        display: block;
        border: 2px solid #e50040;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        top: -4px;
        left: -4px;
        position: absolute;
        opacity: .8;
        -webkit-animation: circle 2s ease-in-out .2s infinite;
        animation: circle 2s ease-in-out .2s infinite;
    }

    .video__icon p {
        color: #000;
        text-align: center;
    }

    @-webkit-keyframes circle {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        to {
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
            opacity: 0;
        }
    }

    @keyframes circle {
        from {
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        to {
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
            opacity: 0;
        }
    }
</style>


<style>
    .bubble {
        display: block;
        position: absolute;
        cursor: pointer;
    }

    .bubble:hover:after {
        background-color: red
    }

    .bubble:after {
        content: "";
        background-color: red;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: absolute;
        display: block;
        top: 1px;
        left: 1px;
    }

    .bubble .bubble-outer-dot {
        margin: 1px;
        display: block;
        text-align: center;
        opacity: 1;
        background-color: rgba(255, 0, 0, 0.4);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        -webkit-animation: bubble-pulse 1.5s linear infinite;
        -moz-animation: bubble-pulse 1.5s linear infinite;
        -o-animation: bubble-pulse 1.5s linear infinite;
        animation: bubble-pulse 1.5s linear infinite
    }

    .bubble .bubble-inner-dot {

        display: block;
        text-align: center;
        opacity: 1;
        background-color: rgba(255, 0, 0, 0.4);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        -webkit-animation: bubble-pulse 1.5s linear infinite;
        -moz-animation: bubble-pulse 1.5s linear infinite;
        -o-animation: bubble-pulse 1.5s linear infinite;
        animation: bubble-pulse 1.5s linear infinite
    }

    .bubble .bubble-inner-dot:after {
        content: "";
        display: block;
        text-align: center;
        opacity: 1;
        background-color: rgba(255, 0, 0, 0.4);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        -webkit-animation: bubble-pulse 1.5s linear infinite;
        -moz-animation: bubble-pulse 1.5s linear infinite;
        -o-animation: bubble-pulse 1.5s linear infinite;
        animation: bubble-pulse 1.5s linear infinite
    }

    @-webkit-keyframes bubble-pulse {
        0% {
            transform: scale(1);
            opacity: .75
        }

        25% {
            transform: scale(1);
            opacity: .75
        }

        100% {
            transform: scale(2.5);
            opacity: 0
        }
    }

    @keyframes bubble-pulse {
        0% {
            transform: scale(1);
            opacity: .75
        }

        25% {
            transform: scale(1);
            opacity: .75
        }

        100% {
            transform: scale(2.5);
            opacity: 0
        }
    }

    @-moz-keyframes bubble-pulse {
        0% {
            transform: scale(1);
            opacity: .75
        }

        25% {
            transform: scale(1);
            opacity: .75
        }

        100% {
            transform: scale(2.5);
            opacity: 0
        }
    }

    @-o-keyframes bubble-pulse {
        0% {
            transform: scale(1);
            opacity: .75
        }

        25% {
            transform: scale(1);
            opacity: .75
        }

        100% {
            transform: scale(2.5);
            opacity: 0
        }
    }


    /*Center-div (Not part of the symbol)*/

    #center-div {
        /* position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0; */
        margin: auto;
        width: 14px;
        height: 14px;
    }
</style>

<?php $per_page = get_settings('content_settings', 'posts_per_page', 6); ?>
<?php
$CI = &get_instance();

$CI->db->select('posts.*, auction.*');
$CI->db->join('auction', 'auction.car_id=posts.id');
$posts = $CI->db->get_where('posts', ['auction.auction_status' => 1, 'is_auction' => 1]); ?>
<div class="block-heading-two">
    <h3 style="padding-bottom: 15px;">
        <span>
            <!-- <i class="fa fa-car"></i> -->
            <?php echo lang_key('Auction'); ?>
        </span>
        <div style="position: relative;">
            <div class="video__icon">
                <div class="circle--outer"></div>
                <div class="circle--inner"></div>
            </div>
        </div>
        <!-- <div id="center-div" style="margin-right: 10px;">
            <div class="bubble">
                <span class="bubble-outer-dot">
                    <span class="bubble-inner-dot"></span>
                </span>
            </div>
        </div> -->

        <!-- <div class="pull-right featured-list-switcher">
            <a target="featured-posts" href="<?php echo site_url('show/auctionposts_ajax/' . $per_page . '/grid'); ?>"><i class="fa fa-th "></i></a>
            <a target="featured-posts" href="<?php echo site_url('show/auctionposts_ajax/' . $per_page . '/list'); ?>"><i class="fa fa-th-list "></i></a>
        </div> -->
    </h3>
</div>
<span class="auction-posts">
    <?php $CI = get_instance(); ?>
    <div class="clearfix"></div>
    <div class="grid-box">

        <?php
        if ($posts->num_rows() <= 0) {
            echo '<div class="alert alert-secondary">' . lang_key('no_posts') . '</div>';
        } else {
            $i = 0;
            foreach ($posts->result() as $post) {
                $i++;
                $detail_link = post_detail_url($post);
        ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="item grid-box-item">
                        <!-- Image style one starts -->

                        <div class="image-style-one">
                            <!-- Image -->
                            <a href="<?php echo $detail_link; ?>">
                                <img class="img-responsive" alt="<?php echo get_post_data_by_lang($post, 'title'); ?>" src="<?php echo get_featured_photo_by_id($post->featured_img); ?>"> <!-- image hover style for image #1 -->
                            </a>
                            <?php if ($post->featured == 1) { ?>
                                <span class="hot-tag" data-toggle="tooltip" data-placement="left" data-original-title="<?php echo lang_key('featured'); ?>"><i class="fa fa-bookmark"></i></span>
                            <?php } ?>
                            <span class="price-tag" data-toggle="tooltip" data-placement="left" data-original-title="<?php echo lang_key('featured'); ?>">
                                $<?php echo $post->min_bid; ?>
                            </span>
                        </div>
                        <div class="grid-box-content" style="padding:12px; padding-top:0;">

                            <span class="condition-tag" data-toggle="tooltip" data-placement="left" data-original-title="<?php echo lang_key('featured'); ?>">
                                <?php echo lang_key('Starting Bid'); ?>
                            </span>

                            <?php
                            $class = "fa cat-img-small ";
                            $bor_class = "";

                            $class .= $CI->post_model->get_category_icon($post->category);
                            $cat_featured_img = $CI->post_model->get_category_featured_img($post->category);

                            if ($i % 5 == 1) {
                                $class .= " bg-red";
                                $bor_class = "bg-red";
                            } else if ($i % 5 == 2) {
                                $class .= " bg-green";
                                $bor_class = "bg-green";
                            } else if ($i % 5 == 3) {
                                $class .= " bg-orange";
                                $bor_class = "bg-orange";
                            } else if ($i % 5 == 4) {
                                $class .= " bg-purple";
                                $bor_class = "bg-purple";
                            } else {
                                $class .= " bg-lblue";
                                $bor_class = "bg-lblue";
                            }
                            ?>
                            <a class="b-tooltip" title="<?php echo get_category_title_by_id($post->category); ?>" href="<?php echo site_url('show/categoryposts/' . $post->category . '/' . dbc_url_title(lang_key(get_category_title_by_id($post->category)))); ?>">
                                <!--i class="category-fa-icon <?php echo $class; ?>"></i-->


                                <img src="<?php echo $cat_featured_img; ?>" class="<?php echo $class; ?>" />
                                <!-- <div style="position: relative;">
                                    <div class="video__icon">
                                        <div class="circle--outer"></div>
                                        <div class="circle--inner"></div>
                                    </div>

                                </div> -->

                            </a>

                            <h4 class="item-title">
                                <a href="<?php echo $detail_link; ?>" style="color:#000000f0"><?php echo format_long_text(get_post_data_by_lang($post, 'title')); ?></a>
                            </h4>

                            <div class="details-cars">
                                <div>
                                    <?php echo get_brand_model_name_by_id($post->brand) . ' ' . get_brand_model_name_by_id($post->model); ?>
                                </div>
                                <div class="info-dta"><i class="fa fa-tachometer"></i> : <?php echo $post->mileage . ' ' . $CI->session->userdata('mileage_unit'); ?></div>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <?php echo (isset($pages)) ? '<ul class="pagination">' . $pages . '</ul>' : ''; ?>
</span>
<div class="ajax-loading featured-loading"><img src="<?php echo theme_url(); ?>/assets/img/loading.gif" alt="loading..."></div>
<a href="" class="load-more-featured btn btn-primary" style="width:100%"><?php echo lang_key('load_more_featured_posts'); ?></a>
<div style="clear:both;margin-top:20px"></div>