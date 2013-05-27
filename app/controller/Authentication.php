<?php

class Authentication {
    protected static $hybrid_config = array(
        "base_url"   => "",
        "providers"  => array (
            "Facebook"   => array (
                "enabled"    => true,
                "keys"       => array ( "id" => "", "secret" => "" ),
            ),
        ),
    );

    public function handle($f3) {
        $socialAuth = new Hybrid_F3(self::$hybrid_config);
        Renderer::render($f3, "we good");
    }
}