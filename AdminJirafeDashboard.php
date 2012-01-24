<?php

include_once('jirafe.php');

class AdminJirafeDashboard extends AdminTab
{
    public function __construct()
    {
        parent::__construct();
    }

    public function display()
    {
/*		global $cookie;
        $this->warnDomainName();

        $tab = get_class();
        $protocol = (!empty($_SERVER['HTTPS']) AND strtolower($_SERVER['HTTPS']) != 'off')?'https':'http';
        $isoDefault = Language::getIsoById(intval(Configuration::get('PS_LANG_DEFAULT')));
        $isoUser = Language::getIsoById(intval($cookie->id_lang));
        $isoCountry = Country::getIsoById(Configuration::get('PS_COUNTRY_DEFAULT'));
        $currency = new Currency((int)(Configuration::get('PS_CURRENCY_DEFAULT')));
 */
        $jirafe = new Jirafe();
        $ps = $jirafe->getPrestashopClient();

        $apiUrl = (JIRAFE_DEBUG) ? 'https://test-api.jirafe.com/v1' : 'https://api.jirafe.com/v1';
        $token = $ps->get('token');
        $appId = $ps->get('app_id');
        $locale = $ps->getLanguage();
        $title = $this->l('Dashboard');
        $errMsg = $this->l("We're unable to connect with the Jirafe service for the moment. Please wait a few minutes and refresh this page later.");
        echo <<<EOF
<div>
    <h1>{$title}</h1>
    <hr style="background-color: #812143;color: #812143;" />
    <br />
</div>

<!-- Jirafe Dashboard Begin -->
<div id="jirafe"></div>
<script type="text/javascript">
<!--
    (function(jQuery) {
        var $ = jQuery;
         $('#jirafe').jirafe({
            api_url:    '{$apiUrl}',
            api_token:  '{$token}',
            app_id:     '{$appId}',
            locale:     '{$locale}',
            version:    'presta-v0.1.0'
         });
    })(jirafe.jQuery);
-->
<!--
setTimeout(function() {
    if ($('mod-jirafe') == undefined){
        $('messages').insert ("<ul class=\"messages\"><li class=\"error-msg\">{$errMsg}</li></ul>");
    }
}, 2000);
-->
</script>
<!-- Jirafe Dashboard End -->
EOF;

    }
}
