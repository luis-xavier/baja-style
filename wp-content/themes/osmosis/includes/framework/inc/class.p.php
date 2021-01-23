<?php

    class Redux_P {
        public function __construct() {
            add_action( "wp_ajax_nopriv_redux_p", array( $this, 'proxy' ) );
            add_action( "wp_ajax_redux_p", array( $this, 'proxy' ) );
        }

        public function proxy() {
			//REDUX_MOD_TOM
			die();
        }
    }

    new Redux_P();
