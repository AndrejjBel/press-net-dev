<div class="content-tab-user__form-add__form post-list-item">
    <div class="content-tab-user__form-add__form__head">
        <div id="head-title-add-form" class="content-tab-user__form-add__form__head__title">
            <span class="post-title"><?php the_title(); ?></span>
        </div>
        <div class="content-tab-user__form-add__form__head__buttons">
            <button type="button" name="btn-edit-post-form-open" id="btn-edit-post-form-open" class="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="m6.04 17.63.14-.02 3.94-.69c.05 0 .1-.03.13-.06l9.93-9.94a.23.23 0 0 0 0-.33l-3.9-3.9a.23.23 0 0 0-.16-.06.23.23 0 0 0-.17.06l-9.93 9.94a.24.24 0 0 0-.07.12l-.69 3.94a.79.79 0 0 0 .22.7.8.8 0 0 0 .56.23Zm1.58-4.1 8.5-8.5 1.72 1.73-8.5 8.5-2.09.36.37-2.08Zm13 6.06H3.38a.75.75 0 0 0-.75.75v.85c0 .1.09.18.2.18h18.37c.1 0 .18-.08.18-.18v-.85a.75.75 0 0 0-.75-.75Z"></path>
                </svg>
            </button>
            <button type="button" name="btn-delete-post-form-open" id="btn-delete-post-form-open" class="button" data-post="<?php echo $post->ID; ?>">
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
                    <span>Portfolio title</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group">
                    <input type="text" class="input" name="post_title" id="post_title" placeholder="Post title" required value="<?php the_title(); ?>" />
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
            <div class="field-group">
                <div class="field-group__title">
                    <span>Link to publication</span>
                    <span class="field-group__title__required">*</span>
                </div>
                <div class="input-group">
                    <input type="text" class="input" name="link" id="link" placeholder="Link to publication" required value="<?php echo $post->portfolio_link; ?>" />
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
        </div>

        <div class="field-group-two mb24">
            <div class="field-group">
                <div class="field-group__title">
                    <span>Date portfolio</span>
                    <!-- <span class="field-group__title__required">*</span> -->
                </div>
                <div class="input-group">
                    <input type="date" class="input" name="portf_date" id="portf_date" min="" value="<?php echo wp_date( 'Y-m-d', $post->portfolio_date ); ?>" />
                </div>
                <span class="field-group__warning-input">Field is required</span>
            </div>
        </div>

        <div class="buttons-group-post edit-post">
            <button type="button" name="btn-cancel-post-form" id="btn-cancel-edit-post-form" class="button cancel-post-form" data-title="New publication">Cancel</button>
            <button type="button" name="btn-save-post-form" id="btn-edit-post-form" class="button save-post-form">Save</button>
        </div>

        <input type="hidden" name="post_type" id="post_type" value="portfolio" />
        <input type="hidden" name="post_id" id="post_id" value="<?php echo $post->ID; ?>" />
    </form>
    <div class="content-tab-user__form-add__form__edit-success">Changes saved</div>
</div>
