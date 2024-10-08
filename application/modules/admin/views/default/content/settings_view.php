<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i><?php echo lang_key("content_settings") ?> </h3>

                <div class="box-tool">
                    <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('msg'); ?>
                <?php echo validation_errors(); ?>
                <?php $settings = json_decode($settings); ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/content/savecontentsettings/'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('publish_posts_directly'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="publish_directly" class="form-control">
                                <?php $options = array('Yes', 'No'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->publish_directly == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="publish_directly_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('publish_directly'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('system_currency'); ?></label>
                        <div class="col-sm-9 col-md-3 controls">
                            <select name="system_currency" class="form-control">
                                <?php $options = get_all_currencies(); ?>
                                <?php foreach ($options as $currency => $val) { ?>
                                    <?php $sel = ($settings->system_currency == $currency) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $currency; ?>" <?php echo $sel; ?>><?php echo $val[0] . ' (' . get_currency_icon($currency) . ' ' . $currency . ')'; ?></option>
                                <?php } ?>
                            </select>
                            <input type="radio" name="system_currency_type" value="0" <?php echo (!isset($settings->system_currency_type) || $settings->system_currency_type == 0) ? 'checked="checked"' : ''; ?>> Use Icon
                            <input type="radio" name="system_currency_type" value="1" <?php echo (isset($settings->system_currency_type) && $settings->system_currency_type == 1) ? 'checked="checked"' : ''; ?>> Use Short Code
                            <input type="hidden" name="system_currency_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('system_currency'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_signup'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_signup" class="form-control">
                                <?php $options = array('Yes', 'No'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->enable_signup == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_signup_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_signup'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('if_package_expired'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="hide_posts_if_expired" class="form-control">
                                <?php $options = array('No' => 'do_not_hide', 'Yes' => 'hide'); ?>
                                <?php foreach ($options as $key => $row) { ?>
                                    <?php $sel = ($settings->hide_posts_if_expired == $key) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo lang_key($row); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="hide_posts_if_expired_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('hide_posts_if_expired'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('show_admin_user'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="show_admin_agent" class="form-control">
                                <?php $options = array('Yes' => 'Yes', 'No' => 'No'); ?>
                                <?php foreach ($options as $key => $row) { ?>
                                    <?php $sel = ($settings->show_admin_agent == $key) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="show_admin_agent_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('show_admin_agent'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('mileage_unit'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="mileage_unit" class="form-control">
                                <?php $options = array('miles', 'kms'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->mileage_unit == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo lang_key($row); ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('mileage_unit'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('Car Mileage Fliter Range'); ?></label>
                        <?php
                        $min_mileage = (set_value('min_car_mileage') != '') ? set_value('min_car_mileage') : ((isset($settings->min_car_mileage)) ? $settings->min_car_mileage : '');
                        $max_mileage = (set_value('max_car_mileage') != '') ? set_value('max_car_mileage') : ((isset($settings->max_car_mileage)) ? $settings->max_car_mileage : '');
                        ?>
                        <div class="col-sm-2 col-lg-2 controls">
                            <input type="text" name="min_car_mileage" value="<?php echo $min_mileage; ?>" placeholder="Min Mileage" class="form-control input-sm">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('min_car_mileage'); ?>
                        </div>

                        <div class="col-sm-2 col-lg-2 controls">
                            <input type="text" name="max_car_mileage" value="<?php echo $max_mileage; ?>" placeholder="Max Mileage" class="form-control input-sm">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('max_car_mileage'); ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('Car Price Fliter Range'); ?></label>
                        <?php
                        $min_price = (set_value('min_car_price') != '') ? set_value('min_car_price') : ((isset($settings->min_car_price)) ? $settings->min_car_price : '');
                        $max_price = (set_value('max_car_price') != '') ? set_value('max_car_price') : ((isset($settings->max_car_price)) ? $settings->max_car_price : '');
                        ?>
                        <div class="col-sm-2 col-lg-2 controls">
                            <input type="text" name="min_car_price" value="<?php echo $min_price; ?>" placeholder="Min Price" class="form-control input-sm">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('min_car_price'); ?>
                        </div>

                        <div class="col-sm-2 col-lg-2 controls">
                            <input type="text" name="max_car_price" value="<?php echo $max_price; ?>" placeholder="Max Price" class="form-control input-sm">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('max_car_price'); ?>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('disable_location'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="disable_location" id="disable_location" class="form-control">
                                <?php $options = array('no' => 'No', 'yes' => 'Yes'); ?>
                                <?php foreach ($options as $key => $row) { ?>
                                    <?php $sel = ($settings->disable_location == $key) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="disable_location_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('disable_location'); ?>
                        </div>
                    </div>

                    <span id="location_settings_holder">
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('show_state_province'); ?></label>

                            <div class="col-sm-9 col-md-3 controls">
                                <select name="show_state_province" class="form-control">
                                    <?php $options = array('yes' => 'Yes', 'no' => 'No'); ?>
                                    <?php foreach ($options as $key => $row) { ?>
                                        <?php $sel = ($settings->show_state_province == $key) ? 'selected="selected"' : ''; ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="show_state_province_rules" value="required">
                                <span class="help-inline">&nbsp;</span>
                                <?php echo form_error('show_state_province'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('city_dropdown'); ?></label>

                            <div class="col-sm-9 col-md-3 controls">
                                <select name="city_dropdown" class="form-control">
                                    <?php $options = array('dropdown' => 'Dropdown', 'autocomplete' => 'Autocomplete'); ?>
                                    <?php
                                    /*
                                    Earlier version does not have city dropdown option
                                    So check for existence
                                    */
                                    if (!isset($settings->city_dropdown))
                                        $settings->city_dropdown = 'autocomplete';
                                    ?>
                                    <?php foreach ($options as $key => $row) { ?>
                                        <?php $sel = ($settings->city_dropdown == $key) ? 'selected="selected"' : ''; ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="city_dropdown_rules" value="required">
                                <span class="help-inline">&nbsp;</span>
                                <?php echo form_error('city_dropdown'); ?>
                            </div>
                        </div>
                    </span>

                    <?php
                    if (get_settings('banner_settings', 'disable_all_map', 'No') == 'No') {
                    ?>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('show_distance_in'); ?></label>

                            <div class="col-sm-9 col-md-3 controls">
                                <select name="show_distance_in" class="form-control">
                                    <?php $options = array('miles' => 'Miles', 'kms' => 'Kms'); ?>
                                    <?php foreach ($options as $key => $row) { ?>
                                        <?php $sel = ($settings->show_distance_in == $key) ? 'selected="selected"' : ''; ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="show_distance_in_rules" value="required">
                                <span class="help-inline">&nbsp;</span>
                                <?php echo form_error('show_distance_in'); ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('posts_per_page'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="posts_per_page" class="form-control">
                                <?php $options = array(4, 8, 12, 16, 20, 24, 28, 32, 36, 40, 46, 50, 100); ?>
                                <?php foreach ($options as $key => $row) { ?>
                                    <?php $sel = ($settings->posts_per_page == $row) ? 'selected="selected"' : ''; ?>
                                    <option <?php echo $sel; ?> value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="posts_per_page_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('posts_per_page'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('show_price_like'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="currency_placing" class="form-control">
                                <?php $options = array('before_with_no_gap' => '$1000', 'before_with_gap' => '$ 1000', 'after_with_no_gap' => '1000$', 'after_with_gap' => '1000 $'); ?>
                                <?php foreach ($options as $key => $row) { ?>
                                    <?php $sel = ($settings->currency_placing == $key) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $key; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="currency_placing_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('currency_placing'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_review'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_review" class="form-control">
                                <?php $options = array('Yes', 'No'); ?>
                                <?php foreach ($options as $val) { ?>
                                    <?php $sel = ($settings->enable_review == $val) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $val; ?>" <?php echo $sel; ?>><?php echo lang_key($val); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_review_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_review'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('max_upload_file_size'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <input type="text" name="max_upload_file_size" value="<?php echo (isset($settings->max_upload_file_size)) ? $settings->max_upload_file_size : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="max_upload_file_size_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('max_upload_file_size'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('recent_posts_order'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="recent_posts_order" class="form-control">
                                <?php $options = array('DESC', 'ASC', 'RANDOM'); ?>
                                <?php foreach ($options as $val) { ?>
                                    <?php $sel = ($settings->recent_posts_order == $val) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $val; ?>" <?php echo $sel; ?>><?php echo lang_key($val); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="recent_posts_order_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('recent_posts_order'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('featured_posts_order'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="featured_posts_order" class="form-control">
                                <?php $options = array('DESC', 'ASC', 'RANDOM'); ?>
                                <?php foreach ($options as $val) { ?>
                                    <?php $sel = ($settings->featured_posts_order == $val) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $val; ?>" <?php echo $sel; ?>><?php echo lang_key($val); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="featured_posts_order_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('featured_posts_order'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('default_posts_order'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="default_posts_order" class="form-control">
                                <?php $options = array('DESC', 'ASC', 'RANDOM'); ?>
                                <?php foreach ($options as $val) { ?>
                                    <?php $sel = ($settings->default_posts_order == $val) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $val; ?>" <?php echo $sel; ?>><?php echo lang_key($val); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="default_posts_order_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('default_posts_order'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_adblocker_alert'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_adblocker_alert" class="form-control">
                                <?php $options = array('No', 'Yes'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->enable_adblocker_alert == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_adblocker_alert_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_adblocker_alert'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_cookie_policy_popup'); ?></label>

                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_cookie_policy_popup" class="form-control">
                                <?php $options = array('Yes', 'No'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->enable_cookie_policy_popup == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_cookie_policy_popup_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_cookie_policy_popup'); ?>
                        </div>
                    </div>

                    <div class="form-group cookie-policy-settings" id="cookie_policy_page_url" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('cookie_policy_page_url'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="cookie_policy_page_url" value="<?php echo (isset($settings->cookie_policy_page_url)) ? $settings->cookie_policy_page_url : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="cookie_policy_page_url_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('cookie_policy_page_url'); ?>
                        </div>
                    </div>
                    <!-- end -->

                    <div style="border-bottom:1px solid #aaa;font-weight:bold;font-size:14px;padding:0 0 5px 5px;"><?php echo lang_key('facebook_app_settings'); ?></div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_facebook_login'); ?></label>
                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_fb_login" class="form-control">
                                <?php $options = array('Yes', 'No'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->enable_fb_login == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_fb_login_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_fb_login'); ?>
                        </div>
                    </div>

                    <div class="form-group fb-settings" id="fb_app_id" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('fb_app_id'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="fb_app_id" value="<?php echo (isset($settings->fb_app_id)) ? $settings->fb_app_id : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="fb_app_id_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('fb_app_id'); ?>
                        </div>
                    </div>

                    <div class="form-group fb-settings" id="fb_secret_key" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('fb_secret_key'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="fb_secret_key" value="<?php echo (isset($settings->fb_secret_key)) ? $settings->fb_secret_key : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="fb_secret_key_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('fb_secret_key'); ?>
                        </div>
                    </div>


                    <!--start-->
                    <!-- added on version 1.7 -->
                    <div style="border-bottom:1px solid #aaa;font-weight:bold;font-size:14px;padding:0 0 5px 5px;"><?php echo lang_key('gplus_app_settings'); ?></div>
                    <span class="settings-help">
                        <div class="alert alert-info">
                            <a href="http://support.webhelios.com/index.php/en/show/faqdetail/26/How-to-get-google+-client-id-and-client-secret" target="_blank" data-toggle="tooltip" data-placement="left" title="Enble google+ api">[<?php echo lang_key('how_to_get_gplus_api'); ?>]</a><br />
                            <?php echo lang_key('auth_redirect_url'); ?>: <?php echo site_url('account/google_plus_auth/auth_callback'); ?>
                        </div>
                    </span>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_gplus_login'); ?></label>
                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_gplus_login" class="form-control">
                                <?php $options = array('No', 'Yes'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $sel = ($settings->enable_gplus_login == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_gplus_login_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_gplus_login'); ?>
                        </div>
                    </div>

                    <div class="form-group gplus-settings" id="gplus_app_id">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('gplus_client_id'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="gplus_app_id" value="<?php echo (isset($settings->gplus_app_id)) ? $settings->gplus_app_id : ''; ?>" placeholder="Type somethin" class="form-control">
                            <input type="hidden" name="gplus_app_id_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('gplus_app_id'); ?>
                        </div>
                    </div>

                    <div class="form-group gplus-settings" id="gplus_secret_key">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('gplus_client_secret'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="gplus_secret_key" value="<?php echo (isset($settings->gplus_secret_key)) ? $settings->gplus_secret_key : ''; ?>" placeholder="Type somethin" class="form-control">
                            <input type="hidden" name="gplus_secret_key_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('gplus_secret_key'); ?>
                        </div>
                    </div>
                    <!-- end -->

                    <div style="border-bottom:1px solid #aaa;font-weight:bold;font-size:14px;padding:0 0 5px 5px;"><?php echo lang_key('comment_settings'); ?></div>

                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_comment'); ?></label>
                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_comment" class="form-control">
                                <?php $options = array('No', 'Facebook Comment', 'Disqus Comment'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $v = (set_value('enable_comment') != '') ? set_value('enable_comment') : $settings->enable_comment; ?>
                                    <?php $sel = ($v == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_comment_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_comment'); ?>
                        </div>
                    </div>

                    <div class="form-group fb-comment-settings" id="fb_app_id" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('fb_app_id'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="fb_comment_app_id" value="<?php echo (isset($settings->fb_comment_app_id)) ? $settings->fb_comment_app_id : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="fb_comment_app_id_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('fb_comment_app_id'); ?>
                        </div>
                    </div>

                    <div class="form-group fb-comment-settings" id="disqus_shortname_holder" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('disqus_shortname'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="disqus_shortname" value="<?php echo (isset($settings->disqus_shortname)) ? $settings->disqus_shortname : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="disqus_shortname_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('disqus_shortname'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('enable_blog_comment'); ?></label>
                        <div class="col-sm-9 col-md-3 controls">
                            <select name="enable_blog_comment" class="form-control">
                                <?php $options = array('No', 'Facebook Comment', 'Disqus Comment'); ?>
                                <?php foreach ($options as $row) { ?>
                                    <?php $v = (set_value('enable_blog_comment') != '') ? set_value('enable_blog_comment') : $settings->enable_blog_comment; ?>
                                    <?php $sel = ($v == $row) ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $row; ?>" <?php echo $sel; ?>><?php echo $row; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="enable_blog_comment_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('enable_blog_comment'); ?>
                        </div>
                    </div>


                    <div class="form-group fb-blog-comment-settings" id="fb_blog_app_id" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('fb_blog_app_id'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="fb_blog_comment_app_id" value="<?php echo (isset($settings->fb_blog_comment_app_id)) ? $settings->fb_blog_comment_app_id : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="fb_blog_comment_app_id_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('fb_blog_comment_app_id'); ?>
                        </div>
                    </div>

                    <div class="form-group fb-blog-comment-settings" id="disqus_blog_shortname_holder" style="display:none">
                        <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('disqus_blog_shortname'); ?></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="disqus_blog_shortname" value="<?php echo (isset($settings->disqus_blog_shortname)) ? $settings->disqus_blog_shortname : ''; ?>" placeholder="<?php echo lang_key('type_something'); ?>" class="form-control">
                            <input type="hidden" name="disqus_blog_shortname_rules" value="required">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('disqus_blog_shortname'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"></label>

                        <div class="col-sm-9 col-lg-10 controls">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i><?php echo lang_key("update") ?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery('#disable_location').change(function() {
            var val = jQuery(this).val();
            if (val == 'yes') {
                jQuery('#location_settings_holder').hide()
            } else {
                jQuery('#location_settings_holder').show()
            }

        }).change();

        jQuery('#enable_bank_transfer').change(function() {
            var val = jQuery(this).val();
            if (val == 'Yes') {
                jQuery('.bank-transfer').show();

                if (jQuery('#enable_feature_payment').val() == 'Yes')
                    jQuery('input[name=featured_payment_bank_instruction_rules]').val('required');
                else
                    jQuery('input[name=featured_payment_bank_instruction_rules]').val('');

                jQuery('input[name=signup_payment_bank_instruction_rules]').val('required');
            } else {
                jQuery('.bank-transfer').hide();
                jQuery('input[name=featured_payment_bank_instruction_rules]').val('');
                jQuery('input[name=signup_payment_bank_instruction_rules]').val('');
            }

        }).change();

        jQuery('#enable_feature_payment').change(function() {
            var val = jQuery(this).val();
            if (val == 'Yes') {
                jQuery('input[name=feature_charge_rules]').val('required');
                jQuery('input[name=feature_day_limit_rules]').val('required');
                jQuery('#feature_payment_settings_panel').show();
            } else {
                jQuery('input[name=feature_charge_rules]').val('');
                jQuery('input[name=feature_day_limit_rules]').val('');
                jQuery('#feature_payment_settings_panel').hide();
            }
        }).change();

        jQuery('select[name=do_water_mark]').change(function(e) {
            var val = jQuery(this).val();
            if (val == 'Yes') {
                jQuery('input[name=water_mark_text_rules]').attr('value', 'required');
                jQuery('#water_mark_text').show();
            } else {
                jQuery('input[name=water_mark_text_rules]').attr('value', '');
                jQuery('#water_mark_text').hide();
            }
        }).change();

        jQuery('select[name=enable_fb_login]').change(function(e) {
            var val = jQuery(this).val();
            if (val == 'Yes') {
                jQuery('input[name=fb_app_id_rules]').attr('value', 'required');
                jQuery('input[name=fb_secret_key_rules]').attr('value', 'required');
                jQuery('.fb-settings').show();
            } else {
                jQuery('input[name=fb_app_id_rules]').attr('value', '');
                jQuery('input[name=fb_secret_key_rules]').attr('value', '');
                jQuery('.fb-settings').hide();
            }
        }).change();

        /* start facebook comment settings */

        jQuery('select[name=enable_comment]').change(function(e) {
            var val = jQuery(this).val();
            if (val == 'Facebook Comment') {
                jQuery('input[name=fb_comment_app_id_rules]').attr('value', 'required');
                jQuery('.fb-comment-settings').show();
            } else {
                jQuery('input[name=fb_comment_app_id_rules]').attr('value', '');
                jQuery('.fb-comment-settings').hide();
            }

            if (val == 'Disqus Comment') {
                jQuery('input[name=disqus_shortname_rules]').attr('value', 'required');
                jQuery('#disqus_shortname_holder').show();
            } else {
                jQuery('input[name=disqus_shortname_rules]').attr('value', '');
                jQuery('#disqus_shortname_holder').hide();
            }
        }).change();

        jQuery('select[name=enable_blog_comment]').change(function(e) {
            var val = jQuery(this).val();
            if (val == 'Facebook Comment') {
                jQuery('input[name=fb_blog_comment_app_id_rules]').attr('value', 'required');
                jQuery('.fb-blog-comment-settings').show();
            } else {
                jQuery('input[name=fb_blog_comment_app_id_rules]').attr('value', '');
                jQuery('.fb-blog-comment-settings').hide();
            }

            if (val == 'Disqus Comment') {
                jQuery('input[name=disqus_blog_shortname_rules]').attr('value', 'required');
                jQuery('#disqus_blog_shortname_holder').show();
            } else {
                jQuery('input[name=disqus_blog_shortname_rules]').attr('value', '');
                jQuery('#disqus_blog_shortname_holder').hide();
            }
        }).change();

        /* end facebook comment settings*/

        jQuery('select[name=enable_gplus_login]').change(function(e) {
            var val = jQuery(this).val();
            if (val == 'Yes') {
                jQuery('input[name=gplus_app_id_rules]').attr('value', 'required');
                jQuery('input[name=gplus_secret_key_rules]').attr('value', 'required');
                jQuery('.gplus-settings').show();
            } else {
                jQuery('input[name=gplus_app_id_rules]').attr('value', '');
                jQuery('input[name=gplus_secret_key_rules]').attr('value', '');
                jQuery('.gplus-settings').hide();
            }
        }).change();

        jQuery('select[name=enable_cookie_policy_popup]').change(function(e) {
            var val = jQuery(this).val();
            if (val == 'Yes') {
                jQuery('input[name=cookie_policy_page_url_rules]').attr('value', 'required');
                jQuery('.cookie-policy-settings').show();
            } else {
                jQuery('input[name=cookie_policy_page_url_rules]').attr('value', '');
                jQuery('.cookie-policy-settings').hide();
            }
        }).change();
    });
</script>