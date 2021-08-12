<?php
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_cmi3'),
            get_string('descconfig', 'block_cmi3')
        ));

$settings->add(new admin_setting_configcheckbox(
            'cmi3/Allow_HTML',
            get_string('labelallowhtml', 'block_cmi3'),
            get_string('descallowhtml', 'block_cmi3'),
            '0'

        ));
