<?php
    namespace Helpers\Interfaces;
    
    interface Authenticateable
    {
        function authenticate(Authentication $authentication);
    }
