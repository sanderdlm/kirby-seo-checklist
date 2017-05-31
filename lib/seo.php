<?php

namespace Seo;


use Masterminds\HTML5;
use DOMXPath;


class Seo
{
    private $output = array();
    private $base_url = '';

    public function __construct()
    {
        $this->base_url = site()->url();
    }

    public function run(){
    	$this->check_sitemap();
    	$this->check_robots();
    	$this->check_meta_tags();
    	$this->check_children();
    	return $this->output;
    }

    private function check_sitemap(){
    	if($this->check_page($this->base_url.'/sitemap') == 404){
		  $this->output['site']['sitemap'] = 'https://getkirby.com/docs/cookbook/xmlsitemap';
		}else{
		  $this->output['site']['sitemap'] = true;
		}
    }

    private function check_robots(){
    	if($this->check_page($this->base_url.'/robots.txt') == 404){
		  $this->output['site']['robots.txt'] = 'https://support.google.com/webmasters/answer/6062608?hl=en';
		}else{
		  $this->output['site']['robots.txt'] = true;
		}
    }

    private function check_meta_tags(){
    	$dom = $this->parse_page($this->base_url);
		$xpath = new DOMXPath($dom);

    	$contents = $xpath->query('/html/head/meta[@name="description"]/@content');
		if ($contents->length != 0) {
		    $this->output['site']['description_meta_tag'] = true;
		}else{
			$this->output['site']['description_meta_tag'] = 'https://moz.com/learn/seo/meta-description';
		}

		//open graph
		$contents = $xpath->query('/html/head/meta[@property="og:title"]/@content');
		if ($contents->length != 0) {
		    $this->output['site']['open_graph_title_tag'] = true;
		}else{
			$this->output['site']['open_graph_title_tag'] = 'http://ogp.me/';
		}

		$contents = $xpath->query('/html/head/meta[@property="og:site_name"]/@content');
		if ($contents->length != 0) {
		    $this->output['site']['open_graph_site_name_tag'] = true;
		}else{
			$this->output['site']['open_graph_site_name_tag'] = 'http://ogp.me/';
		}

		$contents = $xpath->query('/html/head/meta[@property="og:description"]/@content');
		if ($contents->length != 0) {
		    $this->output['site']['open_graph_description_tag'] = true;
		}else{
			$this->output['site']['open_graph_description_tag'] = 'http://ogp.me/';
		}
    }

    private function check_children(){
    	foreach(site()->children() as $page){
			$page_index = $page->uid();
			$dom = $this->parse_page($page->url());

			$this->check_header_tags($dom, $page_index);
			$this->check_img_tags($dom, $page_index);
		}
    }

    private function check_header_tags($dom, $page_index){
    	$this->output['pages'][$page_index]['h1_tag'] = $dom->getElementsByTagName('h1')->length;
    }

    private function check_img_tags($dom, $page_index){
    	
    }

    private function parse_page($url){
		$ch = curl_init($url.'/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($ch);
	  $html5 = new HTML5(array('disable_html_ns' => true));
	  return $html5->loadHTML($content);
		curl_close($ch);
	}

	private function check_page($url){
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_HEADER, true);
	  curl_setopt($ch, CURLOPT_NOBODY  , true);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_exec($ch);
	  return curl_getinfo($ch, CURLINFO_HTTP_CODE);
	  curl_close($ch);
	}
}
