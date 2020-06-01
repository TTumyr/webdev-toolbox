<?php
    class Auth {
        public function __construct($allowed, $origin, $session, $post) {
            $this->allowed = $allowed;
            $this->origin = $origin;
            $this->csrf = [$session, $post];
            $this->verified = false;
        }
        public function check() {
            if($this->csrf[0] === $this->csrf[1]) {
                foreach($this->allowed as $allow) {
                        if($allow === $this->origin) {
                            $this->verified = true;
                        }
                }
            }    
        }
    }
?>