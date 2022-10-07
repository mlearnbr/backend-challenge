<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeComponentsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blade::aliasComponent('default.components.form.input-checkbox', 'inputcheckbox');
        Blade::aliasComponent('default.components.form.input-number', 'inputnumber');
        Blade::aliasComponent('default.components.form.input-password', 'inputpassword');
        Blade::aliasComponent('default.components.form.input-text', 'inputtext');
        Blade::aliasComponent('default.components.form.input-display', 'inputdisplay');
        Blade::aliasComponent('default.components.form.select', 'select');
        Blade::aliasComponent('default.components.form.multi-select', 'multiselect');
        Blade::aliasComponent('default.components.form.textarea', 'textarea');
        Blade::aliasComponent('default.components.table.datatable', 'datatable');
    }
}
