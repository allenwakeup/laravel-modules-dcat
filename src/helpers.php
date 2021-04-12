<?php


if (! function_exists('module_admin_trans_field')) {
    /**
     * Translate the field name.
     *
     * @param $field
     * @param null $locale
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function module_admin_trans_field($field, $locale = null)
    {
        $slug = admin_controller_slug();

        return admin_trans("dcat::{$slug}.fields.{$field}", [], $locale);
    }
}

if (! function_exists('module_admin_trans_label')) {
    /**
     * Translate the label.
     *
     * @param $label
     * @param array $replace
     * @param null  $locale
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function module_admin_trans_label($label = null, $replace = [], $locale = null)
    {
        $label = $label ?: admin_controller_name();
        $slug = admin_controller_slug();

        return admin_trans("dcat::{$slug}.labels.{$label}", $replace, $locale);
    }
}

if (! function_exists('module_admin_trans_option')) {
    /**
     * Translate the field name.
     *
     * @param $field
     * @param array $replace
     * @param null  $locale
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function module_admin_trans_option($optionValue, $field, $replace = [], $locale = null)
    {
        $slug = admin_controller_slug();

        return admin_trans("dcat::{$slug}.options.{$field}.{$optionValue}", $replace, $locale);
    }
}
