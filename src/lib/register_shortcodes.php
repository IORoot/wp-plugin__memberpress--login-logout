<?php

namespace andyp\loginout\lib;

/**
 * Register shortcode for login/logout button
 * 
 * ## usage
 * [login_logout]
 * 
 * or
 * 
 * [login_logout in="login" out="account"]
 * 
 * ## Settings
 * 
 * in = login, logout, account
 * out = login, logout, account
 */
class register_shortcodes
{

    // login, logout, account.
    public $attributes  = [
        'in' =>  'login',
        'out' => 'logout'
    ];

    public $logged_state = 'in';
    public $url         = '';
    public $status      = '';
    public $svg         = '';

    public $output      = '';


    public function __construct(){
        $this->register_shortcodes();
    }

    private function register_shortcodes()
    {
        add_shortcode( 'login_logout', [$this, 'run'] );
    }


    public function run($attributes = array(), $content = null)
    {   
        /**
         * in = [login], logout, account
         * out = login, [logout], account
         */
        if (is_array($attributes)){
            $this->attributes = array_merge($this->attributes, $attributes) ;
        }

        $this->set_defaults();
        $this->check_login_status();
        $this->set_method_to_run();
        $this->template();

        return $this->output;
    }


    /**
     * Set the default output
     */
    private function set_defaults()
    {
        $this->status = 'Login';
        $this->svg = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19,3H5C3.89,3 3,3.89 3,5V9H5V5H19V19H5V15H3V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M10.08,15.58L11.5,17L16.5,12L11.5,7L10.08,8.41L12.67,11H3V13H12.67L10.08,15.58Z"/></svg>';
        $this->url = do_shortcode('[mepr-login-link]');
    }


    /**
     * Determine current status
     */
    private function check_login_status()
    {
        if (is_user_logged_in()){ $this->logged_state = 'out'; }        
    }


    /**
     * If logged in / out - what to use as output.
     */
    private function set_method_to_run()
    {
        if ($this->logged_state == 'in'){  
            $method = $this->attributes['in'];
        }

        if ($this->logged_state == 'out'){  
            $method = $this->attributes['out'];
        }

        $this->$method();

    }


    /**
     * Output template.
     */
    private function template()
    {
        $this->output = '<a class="flex-1 m-3 ml-auto w-11 py-2.5 px-3 font-thin bg-gradient-to-tr from-emerald-400 to-emerald-600 hover:from-amber-400 hover:to-amber-600 rounded-lg hover:fill-white flex flex-row items-center cursor-pointer" href="'.$this->url.'">';
            
            $this->output .= '<div class="w-5 h-5">';
                $this->output .= $this->svg;
            $this->output .= '</div>';


            $this->output .= '<div class="">';
                $this->output .= $this->status;
            $this->output .= '</div>';

        $this->output .= '</a>';
    }

    /**
     * Remove a link HTML to just be the URL.
     */
    private function filter_link_to_url()
    {
        $this->url = preg_replace('/.*href\=\"(.*)\".*/', '$1', $this->url);
    }


    private function login()
    {
        $this->status = '';
        $this->url = do_shortcode('[mepr-login-link]');
        $this->filter_link_to_url();
        $this->svg = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19,3H5C3.89,3 3,3.89 3,5V9H5V5H19V19H5V15H3V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M10.08,15.58L11.5,17L16.5,12L11.5,7L10.08,8.41L12.67,11H3V13H12.67L10.08,15.58Z"/></svg>';
    }

    private function logout()
    {
        $this->status = '';
        $this->url = do_shortcode('[mepr-logout-link]');
        $this->filter_link_to_url();
        $this->svg = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M14.08,15.59L16.67,13H7V11H16.67L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3A2,2 0 0,1 21,5V9.67L19,7.67V5H5V19H19V16.33L21,14.33V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19Z"/></svg>';
    }

    private function account()
    {
        $this->status = '';
        $this->url = '/account';
        $this->svg = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z"/></svg>';
    }




}