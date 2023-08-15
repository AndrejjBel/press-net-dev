<div class="content-tab-user">
    <div class="content-tab-user__title">My speakers</div>
    <div class="content-tab-user__form-add">
        <button type="button" name="btn-add-post-form-open" id="btn-add-post-form-open" class="button btn-add-post mb24">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="ds-btn__prepend">
                <path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18ZM9 12h6M12 9v6"></path>
            </svg>
            <span>Add speaker</span>
        </button>

        <div class="content-tab-user__form-add__form">
            <div class="content-tab-user__form-add__form__head">
                <div id="head-title-add-form" class="content-tab-user__form-add__form__head__title">
                    <span class="post-title">New speaker</span>
                    <svg class="ep-item-card-header-dot add-razdelitel" width="3" height="3" viewBox="0 0 2 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="1" cy="1" r="1" fill="#595959"></circle>
                    </svg>
                    <span class="post-subtitle"></span>
                </div>
            </div>
            <form id="add-employee-form" class="add-employee speaker" enctype="multipart/form-data">
                <div class="form-inputs">
                    <div class="field-group-two mb24">
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>First Name</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group user-first-name">
                                <input type="text" class="input" name="first-name" id="first-name" placeholder="First Name" required value="" />
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                        </div>
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>Last Name</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group user-last-name">
                                <input type="text" class="input" name="last-name" id="last-name" placeholder="Last Name" required value="" />
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                        </div>
                    </div>

                    <div class="field-group-two mb24">
                        <div class="field-group">
                            <div class="field-group__title">
                                <span>E-mail</span>
                                <span class="field-group__title__required">*</span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="input" name="email" id="email" placeholder="E-mail" required value="" />
                            </div>
                            <span class="field-group__warning-input">Field is required</span>
                        </div>
                    </div>

                    <div id="form-expert" class="account-type-form mb24 active">
                        <div class="field-group-two mb20">
                            <div class="field-group">
                                <div class="field-group__title">
                                    <span>Company</span>
                                    <span class="field-group__title__required">*</span>
                                </div>
                                <div class="input-group field-select">
                                    <input type="text" class="input" name="company_name" id="company_name" placeholder="Company" value="" required readonly />
                                    <div class="field-select__options options-company">
                                        <?php press_net_user_media_parent_list('company'); ?>
                                    </div>
                                </div>
                                <span class="field-group__warning-input">Field is required</span>
                                <span class="field-group__warning-input">Must be selected from the list</span>
                                <input type="text" name="company_id" id="company_id" value="" class="input-hidden" required />
                            </div>

                            <div class="checkbox mb14">
                                <div class="field-group__title mb14">
                                    <span>New company</span>
                                </div>
                                <label for="new_company" class="checkbox__label">
                                    <span class="checkbox__label__icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 6L9 17L4 12" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span class="checkbox__label__text">New company</span>
                                </label>
                                <input type="checkbox" name="new_company" id="new_company" class="checkbox__input" />
                                <!-- <span class="checkbox-privacy-text-warning">Field is required</span> -->
                            </div>
                        </div>
                        <div class="new-company-form">
                            <div class="field-group-two mb14">
                                <div class="field-group">
                                    <div class="field-group__title">
                                        <span>Company name</span>
                                        <span class="field-group__title__required">*</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="input" name="company_title" id="company_title" placeholder="Company name" value="" data-required="required" />
                                    </div>
                                    <span class="field-group__warning-input">Field is required</span>
                                </div>
                                <div class="field-group">
                                    <div class="field-group__title">
                                        <span>Job title</span>
                                        <span class="field-group__title__required">*</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="input" name="company_job_title" id="company_job_title" placeholder="Job title" value="" data-required="required" />
                                    </div>
                                    <span class="field-group__warning-input">Field is required</span>
                                </div>
                            </div>

                            <div class="field-group-two mb14">
                                <div class="field-group">
                                    <div class="field-group__title">
                                        <span>Website</span>
                                        <!-- <span class="field-group__title__required">*</span> -->
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="input" name="company_website" id="company_website" placeholder="Website" value="" />
                                    </div>
                                    <!-- <span class="field-group__warning-input">Field is required</span> -->
                                </div>
                                <div class="field-group">
                                    <div class="field-group__title">
                                        <span>City</span>
                                        <!-- <span class="field-group__title__required">*</span> -->
                                    </div>
                                    <div class="input-group">                                        
                                        <input type="text" class="input suggest" name="company_city" id="company_city" placeholder="City" value="" />
                                        <input type="hidden" name="city_obj" id="city_obj" value="">
                                    </div>
                                    <!-- <span class="field-group__warning-input">Field is required</span> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field-group mb24">
                        <div class="field-group__title">
                            <span>Topics covered by the speaker</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group user-themes">
                            <div class="user-themes__items"></div>
                            <div class="user-themes__items__input">
                                <input class="input" type="text" name="themes" id="themes" value="">
                                <span>Add theme</span>
                            </div>
                            <svg class="user-themes__add-item" width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <title>Add a theme</title>
                                <path d="M12 5V19" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M5 12H19" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <input type="hidden" name="user_themes" id="user_themes" value="<?php //echo $author_id; ?>" />
                            <input type="hidden" name="user_themes_edit" id="user_themes_edit" required value="<?php //echo $author_id; ?>" />
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>

                    <div class="field-group mb24">
                        <div class="field-group__title">
                            <span>A short text about the speaker: what he does, what professional interests</span>
                            <span class="field-group__title__required">*</span>
                        </div>
                        <div class="input-group user-description">
                            <textarea type="textarea" rows="4" class="textarea" name="description" id="description" placeholder="A short text about the speaker" required></textarea>
                        </div>
                        <span class="field-group__warning-input">Field is required</span>
                    </div>
                </div>

                <div class="form-avatar">
                    <label for="employee_image_upload" class="label-image-upload">Upload a photo</label>
                    <div class="avatar-upload__img-prev">
                        <img id="result" src="<?php echo get_stylesheet_directory_uri();?>/img/defolt-no-user.svg" alt="">
                    </div>
                    <input type="file" name="employee_image_upload" id="employee_image_upload"  multiple="false" />
                </div>


                <div class="buttons-group-post add-post">
                    <button type="button" name="btn-cancel-employee-form" id="btn-cancel-employee-form" class="button cancel-post-form" data-title="New speaker">Cancel</button>
                    <button type="button" name="btn-save-employee-form" id="btn-save-employee-form" class="button save-post-form">Save</button>
                </div>

                <input type="hidden" name="account_type" id="account_type" value="expert" />
                <input type="hidden" name="post_type" id="post_type" value="company" />
            </form>
        </div>

    </div>
    <div class="content-tab-user__content">
        <div class="content-tab-user__content__posts parent-user-list">
            <?php press_net_get_users_parent('expert'); ?>
        </div>
    </div>
</div>

<?php
// var_dump(press_net_get_users_parent('expert'));
// $object = (object)get_user_meta( $authordata->ID, 'portfolio' )[0];
// $array = (array)get_user_meta( $authordata->ID, 'portfolio' );
// echo '<br>';
// var_dump($object);
// echo '<br>';
// var_dump($array[0]);
