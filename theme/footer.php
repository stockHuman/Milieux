		<aside id="twitter-panel" data-active="false">
			<header><h2>Twitter</h2></header>
			<div id="twitter-panel__inner">
				<a
					class="twitter-timeline"
					data-theme="dark"
					data-link-color="#0093FF"
					data-chrome="noheader nofooter transparent"
					href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</aside>
		<!-- TODO: remove hardcoded contact -->
		<footer class="footer" role="contentinfo">
			<div class="footer__inner">
				<div role="contact" class="footer__contact">
					<h3>Contact</h3>
					<p>
						Milieux Institute for Arts, Culture and Technology at Concordia University<br/>
						1515 Rue Sainte-Catherine W.<br/>
						EV Building, 11.455<br/>
						Montréal, Quebec, Canada<br/>
						H3G 2W1</p>
					<p><a href:mailto="milieux.institute@concordia.ca"></a></p>
				</div>
				<nav role="navigation" class="footer__nav">
					<?php milieux_footer_links(); ?>
				</nav>
			</div>

			<!-- TODO: make this into a menu, add social and page select -->
			<div class="footer__copyright source-org copyright">
				<p>&copy; Copyright <?php echo date('Y'); ?> | <?php bloginfo('name'); ?> | All rights reserved.</p>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->
