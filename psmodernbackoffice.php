<?php
/**
 * Modern Back Office for PrestaShop 9
 *
 * @author    Kamil Chlebek
 * @license   MIT
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Refreshed color scheme for the PrestaShop 9 admin panel - a single stylesheet
 * (views/css/modern.css) loaded after theme.css. No JS, no template overrides,
 * no database changes.
 */
class PsModernBackOffice extends Module
{
    public function __construct()
    {
        $this->name = 'psmodernbackoffice';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Kamil Chlebek';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Modern Back Office');
        $this->description = $this->l('A cleaner, modern look for the PrestaShop 9 admin panel: soft slate background, dark sidebar, blue accent and readable status colors. CSS only.');
        $this->ps_versions_compliancy = ['min' => '9.0.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install() && $this->registerHook('actionAdminControllerSetMedia');
    }

    public function hookActionAdminControllerSetMedia()
    {
        $css = 'views/css/modern.css';
        // filemtime() busts the browser cache whenever the stylesheet changes
        $this->context->controller->addCSS($this->_path . $css . '?v=' . filemtime($this->getLocalPath() . $css), 'all', null, false);
    }
}
