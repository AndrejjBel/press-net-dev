<div class="content-tab-user">
    <div class="content-tab-user__title">Adding a mass media</div>
    <div class="content-tab-user__form-add">
        <button type="button" name="btn-add-post-form-open" id="btn-add-post-form-open" class="button btn-add-post mb24">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="ds-btn__prepend">
                <path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18ZM9 12h6M12 9v6"></path>
            </svg>
            <span>Add mass media</span>
        </button>
        <div class="content-tab-user__form-add__form">
            <div class="content-tab-user__form-add__form__head">
                <div id="head-title-add-form" class="content-tab-user__form-add__form__head__title">
                    <span class="post-title">New mass media</span>
                    <svg class="ep-item-card-header-dot add-razdelitel" width="3" height="3" viewBox="0 0 2 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="1" cy="1" r="1" fill="#595959"></circle>
                    </svg>
                    <span class="post-subtitle"></span>
                </div>
                <div class="content-tab-user__form-add__form__head__buttons">
                    <button type="button" name="btn-edit-post-form-open" id="btn-edit-post-form-open" class="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="m6.04 17.63.14-.02 3.94-.69c.05 0 .1-.03.13-.06l9.93-9.94a.23.23 0 0 0 0-.33l-3.9-3.9a.23.23 0 0 0-.16-.06.23.23 0 0 0-.17.06l-9.93 9.94a.24.24 0 0 0-.07.12l-.69 3.94a.79.79 0 0 0 .22.7.8.8 0 0 0 .56.23Zm1.58-4.1 8.5-8.5 1.72 1.73-8.5 8.5-2.09.36.37-2.08Zm13 6.06H3.38a.75.75 0 0 0-.75.75v.85c0 .1.09.18.2.18h18.37c.1 0 .18-.08.18-.18v-.85a.75.75 0 0 0-.75-.75Z"></path>
                        </svg>
                    </button>
                    <button type="button" name="btn-delete-post-form-open" id="btn-delete-post-form-open" class="button" data-post="no-post">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 7h16M10 11v6M14 11v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <form id="add-post-form">

                <div class="field-group-two mb24">
                    <div class="field-group">
                        <div class="field-group__title">
                            <span>Mass media name</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input" name="post_title" id="post_title" placeholder="Mass media name" required value="" />
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                    <div class="field-group">
                        <div class="field-group__title">
                            <span>Job title</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input" name="job_title" id="job_title" placeholder="Job title" required value="" />
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                </div>

                <div class="field-group-two mb24">
                    <div class="field-group">
                        <div class="field-group__title">
                            <span>Website</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input" name="website" id="website" placeholder="Website" required value="" />
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                    <div class="field-group">
                        <div class="field-group__title">
                            <span>City</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input" name="city" id="city" placeholder="City" required value="" />
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                </div>

                <div class="field-group-two mb24">
                    <div class="field-group">
                        <div class="field-group__title">
                            <span>Subject</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group field-select">
                            <input type="text" class="input" name="subject" id="subject" placeholder="Subject" required value="" readonly />
                            <div class="field-select__options">
                                <?php press_net_tax_list('mass-media-cat', '', '', false, '<span>', '</span>');?>
                            </div>
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                    <div class="field-group">
                        <div class="field-group__title">
                            <span>Format</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group field-select">
                            <input type="text" class="input" name="format" id="format" placeholder="Format" required value="" readonly />
                            <div class="field-select__options">
                                <span>Newspaper</span>
                                <span>Magazine</span>
                                <span>Online media</span>
                                <span>Radio</span>
                                <span>TV</span>
                            </div>
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                </div>

                <div class="field-group mb28">
                    <div class="field-group image-upload">
                        <div class="field-group__title">
                            <span>Logo</span>
                        </div>
                        <div class="input-group media-logo">
                            <img id="logo-result" src="<?php echo get_template_directory_uri(); ?>/img/icons/media-logo-no.svg" data-read="FReadLogo" alt="">
                            <input type="file" name="my_image_upload" id="media_logo"  multiple="false"
                                accept="image/jpeg, image/png, image/pjpeg, image/webp" />
                            <label for="media_logo">Upload media logo</label>
                        </div>
                    </div>
                </div>

                <div class="buttons-group-post add-post">
                    <button type="button" name="btn-cancel-post-form" id="btn-cancel-post-form" class="button cancel-post-form" data-title="New mass media">Cancel</button>
                    <button type="button" name="btn-save-post-form" id="btn-save-post-form" class="button save-post-form">Save</button>
                </div>

                <input type="hidden" name="post_type" id="post_type" value="mass-media" />

            </form>
        </div>
    </div>
    <div class="content-tab-user__content">
        <div class="content-tab-user__content__posts">
            <?php press_net_get_user_posts('mass-media', true); ?>
        </div>
    </div>
</div>
