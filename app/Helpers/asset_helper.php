
<?php if (!env('app.baseURL')===null) exit('No direct script access allowed');


// application/helpers/asset_helper.php
if (!function_exists('assetUrl')) {
    function assetUrl()
    {
        

        // return the asset_url
        //I've added the config item assetsPath
        // in a custom config file which is autoloaded
       
        return env("app.assetURL");
    }
}
