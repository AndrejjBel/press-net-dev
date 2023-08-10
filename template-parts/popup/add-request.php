<div class="modal request-add" data-modal="add-request-form">
    <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/>
    </svg>
    <h4 class="modal__title">Adding a request</h4>
    <div class="modal-content request-call-form">
        <form id="form-add-request">
            <div class="field-group">
                <div class="field-group__title">
                    <span>Request title</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group">
                    <input type="text" class="input" name="post_title" id="post_title" placeholder="Request title" required value="" />
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
            <div class="field-group">
                <div class="field-group__title">
                    <span>Request description</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group user-description">
                    <textarea type="textarea" rows="4" class="textarea" name="description" id="description" placeholder="Request description" required></textarea>
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
            <div class="field-group-two">
                <div class="field-group">
                    <div class="field-group__title">
                        <span>Request rubric</span>
                        <span class="field-group__title__required">*</span>
                    </div>
                    <div class="input-group field-select">
                        <input type="text" class="input" name="rubric_text" id="rubric_text" placeholder="Request rubric" required value="" readonly />
                        <div class="field-select__options">
                            <?php press_net_request_list('requests-cat', $order = 'name', $orderby = 'ASC', $hide_empty = false); ?>
                        </div>
                    </div>
                    <span class="field-group__warning-input">Field is required</span>
                    <span class="field-group__warning-input">Must be selected from the list</span>
                    <input type="hidden" class="input" name="rubric" id="rubric" />
                </div>
                <div class="field-group">
                    <div class="field-group__title">
                        <span>Request type</span>
                        <span class="field-group__title__required">*</span>
                    </div>
                    <div class="input-group field-select">
                        <input type="text" class="input" name="request_type" id="request_type" placeholder="Request type" required value="" readonly />
                        <div class="field-select__options">
                            <span>Texture</span>
                            <span>Barter</span>
                            <span>Texts</span>
                        </div>
                    </div>
                    <span class="field-group__warning-input">Field is required</span>
                </div>
            </div>

            <div class="field-group-two">
                <div class="field-group">
                    <div class="field-group__title">
                        <span>Mass media</span>
                        <span class="field-group__title__required">*</span>
                    </div>
                    <div class="input-group field-select">
                        <input type="text" class="input" name="mass_media_parent" id="mass_media_parent" placeholder="Mass media" required value="" readonly />
                        <div class="field-select__options">
                            <?php press_net_user_media_parent_list(); ?>
                        </div>
                    </div>
                    <span class="field-group__warning-input">Field is required</span>
                    <span class="field-group__warning-input">Must be selected from the list</span>
                    <input type="hidden" class="input" name="mass_media_parent_id" id="mass_media_parent_id" />
                </div>
                <div class="field-group">
                    <div class="field-group__title">
                        <span>Deadline</span>
                        <span class="field-group__title__required">*</span>
                    </div>
                    <div class="input-group">
                        <input type="datetime-local" class="input" name="deadline" id="deadline" min="" required value="" />
                    </div>
                    <span class="field-group__warning-input">Field is required</span>
                </div>
            </div>

            <div class="field-group-two">
                <div class="field-group">
                    <div class="field-group__title">
                        <span>Number of letters from</span>
                        <!-- <span class="field-group__title__required">*</span> -->
                    </div>
                    <div class="input-group">
                        <input type="number" class="input" name="signs_number_from" id="signs_number_from" placeholder="Number of letters from" value="" />
                    </div>
                    <!-- <span class="field-group__warning-input">Field is required</span> -->
                </div>
                <div class="field-group">
                    <div class="field-group__title">
                        <span>Number of letters up to</span>
                        <!-- <span class="field-group__title__required">*</span> -->
                    </div>
                    <div class="input-group">
                        <input type="number" class="input" name="signs_number_upto" id="signs_number_upto" placeholder="Number of letters up to" value="" />
                    </div>
                    <!-- <span class="field-group__warning-input">Field is required</span> -->
                </div>
            </div>

            <div class="buttons-group-post add-post mt24">
                <button type="button" name="btn-cancel-post-form-request" id="btn-cancel-post-form-request" class="button cancel-post-form js-modal-close" data-title="New company">Cancel</button>
                <button type="button" name="btn-save-post-form" id="btn-save-post-form" class="button save-post-form">Save</button>
            </div>

            <input type="hidden" name="post_type" id="post_type" value="requests" />

        </form>
    </div>
</div>
