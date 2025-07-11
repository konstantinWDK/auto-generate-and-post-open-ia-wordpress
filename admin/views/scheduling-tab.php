<?php
/**
 * Scheduling Settings Tab
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<form method="post" action="options.php">
    <?php settings_fields('miapg_scheduling_settings_group'); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e('Auto Scheduling', MIAPG_TEXT_DOMAIN); ?></th>
            <td>
                <select name="auto_scheduling_enabled">
                    <option value="no" <?php selected(Miapg_Settings::get_setting('auto_scheduling_enabled'), 'no'); ?>>No</option>
                    <option value="yes" <?php selected(Miapg_Settings::get_setting('auto_scheduling_enabled'), 'yes'); ?>>Yes</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Posting Frequency', MIAPG_TEXT_DOMAIN); ?></th>
            <td>
                <select name="posting_frequency">
                    <option value="daily" <?php selected(Miapg_Settings::get_setting('posting_frequency'), 'daily'); ?>>Daily</option>
                    <option value="weekly" <?php selected(Miapg_Settings::get_setting('posting_frequency'), 'weekly'); ?>>Weekly</option>
                    <option value="biweekly" <?php selected(Miapg_Settings::get_setting('posting_frequency'), 'biweekly'); ?>>Biweekly</option>
                    <option value="monthly" <?php selected(Miapg_Settings::get_setting('posting_frequency'), 'monthly'); ?>>Monthly</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Posting Time', MIAPG_TEXT_DOMAIN); ?></th>
            <td>
                <input type="time" name="posting_time" value="<?php echo esc_attr(Miapg_Settings::get_setting('posting_time', '09:00')); ?>" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Posting Day', MIAPG_TEXT_DOMAIN); ?></th>
            <td>
                <select name="posting_day">
                    <option value="monday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'monday'); ?>>Monday</option>
                    <option value="tuesday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'tuesday'); ?>>Tuesday</option>
                    <option value="wednesday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'wednesday'); ?>>Wednesday</option>
                    <option value="thursday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'thursday'); ?>>Thursday</option>
                    <option value="friday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'friday'); ?>>Friday</option>
                    <option value="saturday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'saturday'); ?>>Saturday</option>
                    <option value="sunday" <?php selected(Miapg_Settings::get_setting('posting_day'), 'sunday'); ?>>Sunday</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Topics List', MIAPG_TEXT_DOMAIN); ?></th>
            <td>
                <textarea name="auto_topics_list" rows="8" cols="50"><?php echo esc_textarea(Miapg_Settings::get_setting('auto_topics_list')); ?></textarea>
                <p class="description"><?php _e('Enter topics one per line for automatic post generation', MIAPG_TEXT_DOMAIN); ?></p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Auto Delete Used Ideas', MIAPG_TEXT_DOMAIN); ?></th>
            <td>
                <select name="auto_delete_used_ideas">
                    <option value="no" <?php selected(Miapg_Settings::get_setting('auto_delete_used_ideas'), 'no'); ?>>No</option>
                    <option value="yes" <?php selected(Miapg_Settings::get_setting('auto_delete_used_ideas'), 'yes'); ?>>Yes</option>
                </select>
                <p class="description"><?php _e('Delete ideas after they are used to generate posts', MIAPG_TEXT_DOMAIN); ?></p>
            </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>