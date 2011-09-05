<?php

$connections = array
(
     'development' => 'mysql://root:@localhost/nanico_admin_development',
     'production' => 'mysql://root:@localhost/nanico_admin_production',
     'test' => 'mysql://root:@localhost/nanico_admin_test'
);

ActiveRecord\Config::initialize(function($cfg) use ($connections)
{
     $cfg->set_model_directory('models');
     $cfg->set_connections($connections);
     $cfg->set_default_connection(ENVIRONMENT);
});