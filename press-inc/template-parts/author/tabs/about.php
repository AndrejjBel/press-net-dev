<?php
    global $authordata, $current_user, $user_ID;
    $author_id = $authordata->ID;
?>
<div class="author-wrap__main-your-office__content__tab__about">
    <form class="about-fields">
        <!-- <div class="field-group mb24">
            <div class="field-group__title">
                <span>Site status</span>
                <span class="field-group__title__required">*</span>
            </div>
            <div class="two-field">
                <div class="checkbox-group">
                    <label for="expert" class="checkbox-group__label">
                        <span class="checkbox-group__label__icon <?php //echo press_net_get_user_account_type('expert', 'svg');?>">
                            <svg class="<?php //echo press_net_get_user_account_type('expert', 'svg');?>" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="checkbox-group__label__text">Expert</span>
                    </label>
                    <input type="checkbox" name="expert" id="expert" class="checkbox-group__input" <?php echo checked( press_net_get_user_account_type('expert', 'input'), 'expert', false );?>>
                </div>

                <div class="checkbox-group">
                    <label for="journalist" class="checkbox-group__label">
                        <span class="checkbox-group__label__icon <?php //echo press_net_get_user_account_type('journalist', 'svg');?>">
                            <svg class="<?php //echo press_net_get_user_account_type('journalist', 'svg');?>" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="checkbox-group__label__text">Journalist</span>
                    </label>
                    <input type="checkbox" name="journalist" id="journalist" class="checkbox-group__input" <?php //echo checked( press_net_get_user_account_type('journalist', 'input'), 'journalist', false );?>>
                </div>
            </div>
            <span id="types_error" class="field-group__warning-input">Field is required</span>
        </div> -->

        <div class="field-group mb24">
            <div class="field-group__title">
                <span>First Name</span>
                <span class="field-group__title__required">*</span>
            </div>
            <div class="input-group user-first-name">
                <input type="text" class="input" name="first-name" id="first-name" placeholder="First Name" required value="<?php echo press_net_get_authordata('first_name'); ?>" />
            </div>
            <span class="field-group__warning-input">Field is required</span>
        </div>

        <div class="field-group mb24">
            <div class="field-group__title">
                <span>Last Name</span>
                <span class="field-group__title__required">*</span>
            </div>
            <div class="input-group user-last-name">
                <input type="text" class="input" name="last-name" id="last-name" placeholder="Last Name" required value="<?php echo press_net_get_authordata('last_name'); ?>" />
            </div>
            <span class="field-group__warning-input">Field is required</span>
        </div>

        <div class="field-group mb24">
            <div class="field-group__title">
                <span>About me</span>
            </div>
            <div class="input-group user-description">
                <textarea type="textarea" rows="4" class="textarea" name="description" id="description" placeholder="About me"><?php echo press_net_get_authordata('description'); ?></textarea>
            </div>
        </div>

        <!-- <div class="field-group mb24">
            <div class="field-group__title">
                <span>My themes</span>
            </div>
            <div class="input-group user-themes">
                <div class="user-themes__items">
                    <?php //press_net_get_user_themes(); ?>
                </div>
                <div class="user-themes__items__input">
                    <input class="input" type="text" name="themes" id="themes" value="">
                    <span>Add theme</span>
                </div>
                <svg class="user-themes__add-item" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <title>Add a theme</title>
                    <path d="M12 5V19" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M5 12H19" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <input type="hidden" name="user_themes" id="user_themes" value="<?php echo $user_themes; ?>" />
                <input type="hidden" name="user_themes_edit" id="user_themes_edit" value="" />
            </div>
        </div> -->

        <button class="button btn-primary mb28" type="submit" name="author-lk-submit" id="author-lk-submit">Save</button>

        <input type="hidden" name="author_archive_id" id="author_archive_id" value="<?php echo $author_id; ?>" />

        <?php wp_nonce_field( 'user_profile_edit', 'user_profile_edit' ); ?>

    </form>

    <form id="user_avatar_upload" class="avatar-upload" method="post" action="#" enctype="multipart/form-data">
        <div class="avatar-title">My Photo</div>
        <label for="my_image_upload" class="label-image-upload">Upload a photo</label>
        <div class="avatar-upload__img-prev">
            <?php echo press_net_get_avatar_user_img(); ?>
        </div>
        <input type="file" name="my_image_upload" id="my_image_upload"  multiple="false"
            accept="image/jpeg, image/png, image/pjpeg, image/webp" />
        <input type="hidden" name="author_archive_id" id="author_archive_id" value="<?php echo $author_id; ?>" />
        <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo $user_ID; ?>" />
        <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
        <?php if ( press_net_get_is_avatar_user() ) { ?>
            <button type="button" name="button-image-upload" id="button-image-delete" class="button btn-image-delete">Remove avatar</button>
        <?php } ?>
    </form>
</div>
<div class="notif-custom-reg"></div>
