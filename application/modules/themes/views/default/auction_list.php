<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .auction-list-view {
        padding: 20px 10px;
    }

    .product-card {
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-bottom: 20px;
        width: 250px;
        height: 420px;
    }

    #imgSlider .ProductImages img {
        height: 150px;
        overflow: hidden;
        width: 100% !important;
        border-radius: 15px 15px 0px 0px;
    }

    .product-details {
        padding: 10px;
        height: 130px;
    }

    .product-title {
        font-size: 18px;
        font-weight: 500;
        color: #461d51;
    }

    .product-footer {
        height: 40px;
        padding-bottom: 5px;
    }

    .product-footer a {
        margin-bottom: 10px;
    }

    .product-model {
        font-size: 15px;
        font-weight: 500;
    }



    /* .product-card img {
        height: 100% !important;
        width: 100% !important;
    } */

    .owl-carousel .owl-item img {
        display: inline-block !important;
    }

    .owl-stage-outer .item {
        display: flex;
        justify-content: center;
    }

    .owl-nav {
        position: absolute;
        top: 35%;
        width: 100%;
    }

    .owl-nav button {
        width: 35px;
    }

    .owl-nav span {
        font-size: 50px;
    }

    .owl-nav .owl-prev {
        position: absolute;
        left: -40px;
    }

    .owl-nav .owl-next {
        position: absolute;
        right: -40px;
    }
</style>

<style>
    .timer-div {
        display: flex;
        justify-content: center;
    }

    .timer-div ul li {
        padding: 5px;
        width: 35px;
        height: 35px;
        background-color: red;
        color: #fff;
        margin: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 500;
        border-radius: 10px;
    }

    .timer-div ul {
        display: flex;
        align-items: baseline;
    }
</style>

<script>
    function countEndDate(id, end_time) {
        // Set the date we're counting down to
        var countDownDate = new Date(end_time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.querySelector(".days" + id).innerHTML = days;
            document.querySelector(".hours" + id).innerHTML = hours;
            document.querySelector(".minutes" + id).innerHTML = minutes;
            document.querySelector(".seconds" + id).innerHTML = seconds;

            // If the count down is finished, write some text 
            if (distance < 0) {
                clearInterval(x);
                // document.getElementById("timer").innerHTML = "EXPIRED";
                document.querySelector(".days" + id).innerHTML = 0;
                document.querySelector(".hours" + id).innerHTML = 0;
                document.querySelector(".minutes" + id).innerHTML = 0;
                document.querySelector(".seconds" + id).innerHTML = 0;
            }
        }, 1000);
    }
</script>

<?php
$CI = &get_instance();

$CI->db->select('posts.*, auction.*');
$CI->db->join('auction', 'auction.car_id=posts.id');
$posts = $CI->db->get_where('posts', ['auction.auction_status' => 1, 'is_auction' => 1])->result();


// date_default_timezone_set('Asia/Dhaka');
$timezone = date_default_timezone_get();
?>



<div class="auction-list-view">
    <div id="productSlider" class="owl-carousel owl-theme">
        <?php
        foreach ($posts as $post) {
            if (($post->start_time) <= date('Y-m-d h:i:s') && ($post->end_time) >= date('Y-m-d h:i:s')) {

                $detail_link = post_detail_url($post); ?>
                <div class="item">
                    <div class="product-card">
                        <div class="image-slider" id="imgSlider">
                            <a href="<?php echo $detail_link; ?>">
                                <div id="ProductImages<?= $post->id ?>" class="ProductImages">
                                    <?php

                                    if ($post->featured_img == '') {
                                    ?>
                                        <div data-thumb="<?php echo base_url() . 'assets/admin/img/preview.jpg'; ?>" data-src="<?php echo base_url() . 'assets/admin/img/preview.jpg'; ?>">
                                            <span class="helper"></span><img src="<?php echo base_url() . 'assets/admin/img/preview.jpg'; ?>" />
                                        </div>

                                    <?php
                                    } else {
                                    ?>
                                        <div data-thumb="<?php echo base_url() . 'uploads/images/' . $post->featured_img ?>" data-src="<?php echo base_url() . 'uploads/images/' . $post->featured_img ?>">
                                            <span class="helper"></span><img src="<?= file_exists('uploads/images/' . $post->featured_img) ? base_url() . 'uploads/images/' . $post->featured_img : base_url() . 'assets/admin/img/preview.jpg' ?>" />
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                        </div>
                        <div class="product-details">
                            <p class="product-title"> <?= format_long_text(get_post_data_by_lang($post, 'title')) ?></p>
                            <!-- <p class="product-model"> <?= get_brand_model_name_by_id($post->model) ?> </p> -->

                            <?php
                            $bid = $this->db->order_by('amount', 'DESC')->where('car_id', $post->id)->get('bid')->row();
                            if (!empty($bid)) { ?>
                                <p class="product-current-bid"><span style="color: gray; font-weight: bold;">Highest Bid: </span> <span style="font-size: 25px; color: green; font-weight: 600;"><?= number_format($bid->amount, 2) ?></span> USD</p>
                            <?php } else {
                            ?>
                                <p class="product-current-bid"><span style="color: gray; font-weight: bold;">Current Bid: </span> <span style="font-size: 25px; color: green; font-weight: 600;"><?= number_format($post->min_bid, 2) ?></span> USD</p>
                            <?php } ?>
                            <p class="product-location"><strong>Location: </strong><?= get_location_name_by_id($post->city) ?></p>
                        </div>
                        <div class="text-center product-footer" style="margin: 15px 0px;">
                            <a href="<?= $detail_link ?>" class="btn btn-warning" style="border-radius: 30px; font-weight:500">View Details</a>
                            <div class="timer-div">
                                <ul id="timer" style="display: flex;">
                                    <li class="circle days<?= $post->id ?>"></li>:
                                    <li class="circle hours<?= $post->id ?>"></li>:
                                    <li class="circle minutes<?= $post->id ?>"></li>:
                                    <li class="circle seconds<?= $post->id ?>"></li>
                                </ul>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    countEndDate(<?= $post->id ?>, '<?= $post->end_time ?> <?= $timezone == 'UTC' ? 'UTC' : '' ?>');
                                });
                            </script>
                        </div>
                    </div>
                </div>
        <?php  }
        }
        ?>
    </div>
</div>

<!-- <script>
    $('.ProductImages').lightSlider({
        item: 1,
        rtl: true,
        loop: true,
        pause: 0,
        slideMargin: 0,
        verticalHeight: 300,
    });
</script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#productSlider').owlCarousel({
        loop: true,
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });
</script>