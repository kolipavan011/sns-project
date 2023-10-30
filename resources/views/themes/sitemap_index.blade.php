<?php
echo '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="//storynstatus.test/template.xsl"?>';
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@foreach ($sitemaps as $sitemap)
	<sitemap>
		<loc>{{ $sitemap['url'] }}</loc>
		<lastmod>{{ $sitemap['time'] }}</lastmod>
	</sitemap>
	@endforeach
</sitemapindex>