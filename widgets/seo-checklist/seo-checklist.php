<?php

$s = new \Seo\Seo();
$seo_analytics = $s->run();

if(panel()->user()->role() == 'admin') {
  return array(
    'title' => 'SEO checklist',
    'html'    => function() use($seo_analytics) {

      return tpl::load(__DIR__ . DS . 'template.php', array(
        'data' => $seo_analytics
      ));

    }
  );
} else {
  return false;
}
