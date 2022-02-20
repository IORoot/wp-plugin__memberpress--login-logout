<?php

namespace andyp\loginout;

class initialise {


    public function __construct()
    {
        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                        Register Shortcode    	                         │
        // └─────────────────────────────────────────────────────────────────────────┘
        $this->register_shortcodes();
    }
    
    /**
     * Create the [sidebar_menu] shortcode.
     */
    public function register_shortcodes()
    {
        new lib\register_shortcodes;
    }

}