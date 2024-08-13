        <script type="text/javascript">
            var menu_title = '<//?php echo lang_key("MENU"); ?>';
        </script>
        <!-- <div class="offcanvas-overlay"></div> -->

        <!-- <div class="top-bar <//?php echo (isset($alias) && $alias == 'home') ? 'box-top-bar' : 'static-top-bar'; ?>">
            <div class="container">
                <//?php render_widget('top_bar'); ?>
                <div class="tb-language dropdown pull-right">
                    <//?php
                    $CI         = get_instance();
                    $uri        = current_url();
                    $curr_lang  = get_current_lang();
                    $CI->load->config('common');
                    $languages = $CI->config->item('active_languages');
                    ?>
                    <a href="#" data-target="#" data-toggle="dropdown"><i class="fa fa-globe"></i> <?php echo (isset($languages[$curr_lang])) ? $languages[$curr_lang] : 'language'; ?> <i class="fa fa-angle-down color"></i></a>
                    <//?php
                    if ($CI->uri->segment(1) == '')
                        $uri .= '/' . default_lang();
                    echo '<ul class="dropdown-menu dropdown-mini" role="menu">';
                    $url = $uri;

                    foreach ($languages as $short_name => $long_name) {
                        $uri = str_replace_second('/' . $curr_lang, '/' . $short_name, $url);
                        $sel = ($curr_lang == $short_name) ? 'active' : '';
                        echo '<li class="' . $sel . '"><a href="' . $uri . '">' . $long_name . '</a></li>';
                    }
                    echo '</ul>';
                    ?>

                </div>
                <? //php render_widget('top_bar_social'); 
                ?>
                <div class="clearfix"></div>
            </div>
        </div> -->

        <!-- <div class="clearfix"></div> -->

        <header id="header" class="sticky <?php echo (isset($alias) && $alias == 'home') ? 'box-header' : 'full-header static-header'; ?>">
            <div class="container">
                <div class="row box-header-wrap">

                    <div class="col-sm-2 col-xs-4 logo-col">
                        <div id="logo" class="logos">
                            <?php
                            $logo_type = get_settings('site_settings', 'logo_type', 'Image');
                            if ($logo_type == 'Image') {
                            ?>
                                <h3>
                                    <a href="<?php echo site_url(); ?>" class="standard-logo pull-left">
                                        <img class="header-logo" src="<?php echo get_site_logo(); ?>" alt="Logo">
                                    </a>
                                </h3>
                            <?php
                            } else {
                            ?>
                                <a href="<?php echo site_url(); ?>" class="standard-logo pull-left">
                                    <h1 class="logo-text" style="color:<?php echo get_settings('site_settings', 'logo_text_color', '#222'); ?>">
                                        <?php echo  get_settings('site_settings', 'logo_text', 'No Logo') ?>
                                    </h1>
                                </a>
                            <?php
                            }
                            ?>

                        </div>
                    </div>

                    <div class="col-sm-8 col-xs-8">

                        <nav class="main-nav pull-right">
                            <ul>
                                <?php
                                $CI = get_instance();
                                $CI->load->model('admin/page_model');
                                $CI->page_model->init();
                                $alias = (isset($alias)) ? $alias : '';
                                foreach ($CI->page_model->get_menu() as $li) {
                                    if ($li->parent == 0)
                                        $CI->page_model->render_top_menu($li->id, 0, $alias);
                                }
                                ?>

                                <?php if (!is_loggedin()) { ?>
                                    <?php if (get_settings('content_settings', 'enable_signup', 'Yes') == 'Yes') { ?>
                                        <!-- <li class="">
                                            <a class="signup" href="<?php echo site_url('account/signupform'); ?>"><?php echo lang_key('signup') ?></a>
                                        </li> -->
                                    <?php } ?>
                                    <li class="">
                                        <a class="signin" href="#"><?php echo lang_key('signin'); ?></a>
                                    </li>
                                <?php } else { ?>
                                    <li class="">
                                        <a class="signup" href="<?php echo site_url('admin'); ?>"><?php echo lang_key('user_panel'); ?></a>
                                    </li>
                                    <li class="">
                                        <?php if ($this->session->userdata('fbloggeduser') == 1) { ?>
                                            <!-- <a class="signup" href="javascript:void(0);" onclick="logout();"><?php echo lang_key('logout'); ?></a> -->
                                        <?php } else { ?>
                                            <!-- <a class="signup" href="<?php echo site_url('account/logout'); ?>"><?php echo lang_key('logout'); ?></a> -->
                                        <?php } ?>
                                    </li>

                                <?php } ?>

                            </ul>
                        </nav>

                        <div class="offcanvas-toggler pull-right">
                            <i id="offcanvas-opener" class="fa fa-bars" style="color:#fff;"></i>
                            <i id="offcanvas-closer" class="fa fa-close" style="color:#fff;"></i>

                        </div>
                        <div id="search-icon">
                            <i class='fa fa-search fa-5x home_mobile_search_active'></i>
                        </div>
                    </div>

                </div>
            </div>
            <div id="front-header-search" class="flex-grow-1 front-header-search d-flex align-items-center bg-white mx-xl-5 active">
                <div class=" position-relative flex-grow-1 px-3 px-lg-0">
                    <form class="stop-propagation">
                        <div class="front-header-search-from">
                            <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                <div class="px-2 home_mobile_search_unactive" type="button"><i class="fa fa-arrow-left"></i></div>
                            </div>
                            <div class="search-input-box">
                                <input type="text" class="border border-soft-light form-control fs-14 hov-animate-outline" id="search" name="keyword" placeholder="Search Your Dream Car..." autocomplete="off">
                                <i class='fa fa-search search-input-box-icon' onclick="home_mobile_search_active" style='color:#000'></i>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </header>



        <!-- ========== START MOBILE NAV ========== -->
        <nav class="mobile-nav">
            <ul>
                <?php
                $CI = get_instance();
                $CI->load->model('admin/page_model');
                $CI->page_model->init();
                $alias = (isset($alias)) ? $alias : '';
                foreach ($CI->page_model->get_menu() as $li) {
                    if ($li->parent == 0)
                        $CI->page_model->render_top_menu($li->id, 0, $alias, TRUE);
                }
                ?>

                <?php if (!is_loggedin()) { ?>
                    <?php if (get_settings('content_settings', 'enable_signup', 'Yes') == 'Yes') { ?>
                        <li class="">
                            <a class="signup" href="<?php echo site_url('account/signupform'); ?>"><?php echo lang_key('signup') ?></a>
                        </li>
                    <?php } ?>
                    <li class="">
                        <a class="signin" href="#"><?php echo lang_key('signin'); ?></a>
                    </li>
                <?php } else { ?>
                    <li class="">
                        <a class="signup" href="<?php echo site_url('admin'); ?>"><?php echo lang_key('user_panel'); ?></a>
                    </li>
                    <li class="">
                        <a class="signup" href="<?php echo site_url('account/logout'); ?>"><?php echo lang_key('logout'); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- end mobile nav -->



        <script>
            var searchField = document.querySelector('.front-header-search');
            var searchActive = document.querySelector('.home_mobile_search_active');
            var searchRemove = document.querySelector('.home_mobile_search_unactive');
            searchRemove.addEventListener('click', function() {
                searchField.style.top = '-190px';
            })
            searchActive.addEventListener('click', function() {
                searchField.style.top = '0px';
            })
        </script>