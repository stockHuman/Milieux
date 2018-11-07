		<aside id="twitter-panel" data-active="false">
			<header><h2>Twitter</h2></header>
			<div id="twitter-panel__inner">
				<a
					class="twitter-timeline"
					data-theme="dark"
					data-link-color="#0093FF"
					data-chrome="noheader nofooter transparent"
					href="https://twitter.com/milieux_news">Tweets by Milieux</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</aside>
		<?php edit_post_link('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M93.084,33.246c-1.059,0-1.915,0.857-1.915,1.915l-0.001,48.342c0,2.037-0.798,3.958-2.249,5.411  c-1.448,1.453-3.367,2.252-5.403,2.252l-67.021,0.003c-4.224-0.002-7.661-3.44-7.661-7.666L8.83,16.491  c0.001-4.223,3.438-7.66,7.663-7.66H64.85c1.059,0,1.916-0.857,1.916-1.915s-0.857-1.915-1.916-1.915H16.493  c-6.337,0-11.492,5.154-11.493,11.49l0.003,67.012c0,6.336,5.153,11.492,11.49,11.496c0,0,67.021-0.003,67.026-0.003  c3.056,0,5.937-1.198,8.109-3.376c2.173-2.177,3.37-5.06,3.369-8.117l0.001-48.342C94.999,34.103,94.143,33.246,93.084,33.246z"/><path d="M34.52,55.172l-2.503,9.365c-0.249,0.945-0.094,1.848,0.437,2.537c0.498,0.646,1.279,1.019,2.143,1.019  c0.277,0,0.563-0.038,0.863-0.116l9.367-2.504c1.75-0.459,4.026-1.772,5.291-3.047l41.569-41.573  c1.68-1.675,2.604-3.905,2.604-6.276s-0.925-4.598-2.604-6.27c-1.676-1.674-3.902-2.596-6.269-2.596  c-2.368,0-4.597,0.923-6.276,2.599L37.565,49.886C36.291,51.169,34.981,53.441,34.52,55.172z M50.691,56.436l-7.127-7.134  l32.201-32.2l7.13,7.127L50.691,56.436z M81.848,11.019c0.957-0.954,2.223-1.479,3.571-1.479c1.345,0,2.608,0.524,3.563,1.478  c0.953,0.951,1.479,2.215,1.479,3.56c0,1.345-0.526,2.611-1.481,3.565l-3.378,3.378l-7.13-7.127L81.848,11.019z M40.278,52.589  l0.58-0.579l7.126,7.134l-0.579,0.579c-0.781,0.786-2.472,1.76-3.558,2.045l-7.674,2.053l2.048-7.661  C38.507,55.086,39.49,53.383,40.278,52.589z"/></svg>', '', '', '','post-edit-link no-barba'); // 'edit' by David from the Noun Project ?>
		<footer class="footer" role="contentinfo">
			<div class="footer__inner">
				<div class="footer__branding">
					<img src="<?= get_template_directory_uri() . '/assets/images/milieux-logo.svg'; ?>" alt="Milieux Logo">
					<img src="<?= get_template_directory_uri() . '/assets/images/concordia-logo.png'; ?>" alt="Concordia Logo">
				</div>
				<div role="contact" class="footer__contact">
					<h4><?= __('Contact', 'milieux'); ?></h4>
					<p> <!-- TODO: make this a setting -->
						Milieux Institute for Arts, Culture and Technology at Concordia University<br/>
						1515 Rue Sainte-Catherine W.<br/>
						EV Building, 11.455<br/>
						Montréal, Quebec, Canada<br/>
						h4G 2W1</p>
					<p><a href:mailto="milieux.institute@concordia.ca"></a></p>
				</div>
				<nav role="navigation" class="footer__nav">
					<h4><?= __('Milieux', 'milieux'); ?></h4>
					<?php milieux_footer_links(); ?>
				</nav>
				<nav role="navigation" class="footer__clusters">
					<h4><?= __( 'Clusters', 'milieux'); ?></h4>
					<?php milieux_clusters_menu(); ?>
				</nav>
			</div>

			<!-- TODO: make this into a menu, add social and page select -->
			<div class="footer__copyright source-org copyright">
				<p>&copy; Copyright <?php echo date('Y'); ?> | <?php bloginfo('name'); ?> | All rights reserved.</p>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>
