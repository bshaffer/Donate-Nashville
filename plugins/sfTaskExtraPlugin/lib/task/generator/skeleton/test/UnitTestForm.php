<?php

/**
 * ##CLASS## tests.
 */
include dirname(__FILE__).'##TEST_DIR##/bootstrap/unit.php';
##DATABASE##
$t = new lime_test(0, new lime_output_color());

// ->configure()
$t->diag('->configure()');

$f = new ##CLASS##();
unset($f[sfForm::getCSRFTokenField()]);
$t->is_deeply($f->getWidgetSchema()->getPositions(), array(), '->configure() sets the expected fields');

##TESTS##
