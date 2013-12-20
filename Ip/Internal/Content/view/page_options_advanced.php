<form id="formAdvanced">
    <label><?php _e('Type', 'ipAdmin') ?></label>
    <p class="field">
        <input id="ipContentManagementTypeDefault" class="stdModBox" name="type" value="default" <?php echo $element->getType() == 'default' ? 'checked="checked"' : '' ?> type="radio" />
        <label for="ipContentManagementTypeDefault" class="small">
            <?php _e('Display page content', 'ipAdmin') ?>
        </label>
        <br />
    </p>
    <p class="field">
        <input id="ipContentManagementTypeInactive" class="stdModBox" name="type" value="inactive" <?php echo $element->getType() == 'inactive' ? 'checked="checked"' : '' ?> type="radio" />
        <label for="ipContentManagementTypeInactive" class="small">
            <?php _e('Inactive (without link on it)', 'ipAdmin') ?>
        </label>
        <br />
    </p>
    <p class="field">
        <input id="ipContentManagementTypeSubpage" class="stdModBox" name="type" value="subpage" <?php echo $element->getType() == 'subpage' ? 'checked="checked"' : '' ?> type="radio" />
        <label for="ipContentManagementTypeSubpage" class="small">
            <?php _e('Redirect to first sub-page', 'ipAdmin') ?>
        </label>
        <br />

    <p/>

    <san class="error" id="redirectURLError"></san>
    <p class="field">
        <input id="ipContentManagementTypeRedirect" class="stdModBox" name="type" value="redirect" <?php echo ($element->getType() == 'redirect' ? 'checked="checked"' : '' )?> type="radio" />
        <label for="ipContentManagementTypeRedirect" class="small">
            <?php _e('Redirect to external page', 'ipAdmin') ?>
        </label>
        <br />
        <input autocomlete="off" name="redirectURL" value="<?php echo $element->getRedirectUrl() ?>">
        <span>Please use "Menu Management" tab for internal linkig options</span>
        <br />
    </p>

</form>