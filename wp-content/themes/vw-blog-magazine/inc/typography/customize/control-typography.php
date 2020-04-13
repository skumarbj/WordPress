<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Blog_Magazine_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-blog-magazine' ),
				'family'      => esc_html__( 'Font Family', 'vw-blog-magazine' ),
				'size'        => esc_html__( 'Font Size',   'vw-blog-magazine' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-blog-magazine' ),
				'style'       => esc_html__( 'Font Style',  'vw-blog-magazine' ),
				'line_height' => esc_html__( 'Line Height', 'vw-blog-magazine' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-blog-magazine' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-blog-magazine-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-blog-magazine-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-blog-magazine' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-blog-magazine' ),
        'Acme' => __( 'Acme', 'vw-blog-magazine' ),
        'Anton' => __( 'Anton', 'vw-blog-magazine' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-blog-magazine' ),
        'Arimo' => __( 'Arimo', 'vw-blog-magazine' ),
        'Arsenal' => __( 'Arsenal', 'vw-blog-magazine' ),
        'Arvo' => __( 'Arvo', 'vw-blog-magazine' ),
        'Alegreya' => __( 'Alegreya', 'vw-blog-magazine' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-blog-magazine' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-blog-magazine' ),
        'Bangers' => __( 'Bangers', 'vw-blog-magazine' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-blog-magazine' ),
        'Bad Script' => __( 'Bad Script', 'vw-blog-magazine' ),
        'Bitter' => __( 'Bitter', 'vw-blog-magazine' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-blog-magazine' ),
        'BenchNine' => __( 'BenchNine', 'vw-blog-magazine' ),
        'Cabin' => __( 'Cabin', 'vw-blog-magazine' ),
        'Cardo' => __( 'Cardo', 'vw-blog-magazine' ),
        'Courgette' => __( 'Courgette', 'vw-blog-magazine' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-blog-magazine' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-blog-magazine' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-blog-magazine' ),
        'Cuprum' => __( 'Cuprum', 'vw-blog-magazine' ),
        'Cookie' => __( 'Cookie', 'vw-blog-magazine' ),
        'Chewy' => __( 'Chewy', 'vw-blog-magazine' ),
        'Days One' => __( 'Days One', 'vw-blog-magazine' ),
        'Dosis' => __( 'Dosis', 'vw-blog-magazine' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-blog-magazine' ),
        'Economica' => __( 'Economica', 'vw-blog-magazine' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-blog-magazine' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-blog-magazine' ),
        'Francois One' => __( 'Francois One', 'vw-blog-magazine' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-blog-magazine' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-blog-magazine' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-blog-magazine' ),
        'Handlee' => __( 'Handlee', 'vw-blog-magazine' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-blog-magazine' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-blog-magazine' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-blog-magazine' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-blog-magazine' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-blog-magazine' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-blog-magazine' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-blog-magazine' ),
        'Kanit' => __( 'Kanit', 'vw-blog-magazine' ),
        'Lobster' => __( 'Lobster', 'vw-blog-magazine' ),
        'Lato' => __( 'Lato', 'vw-blog-magazine' ),
        'Lora' => __( 'Lora', 'vw-blog-magazine' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-blog-magazine' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-blog-magazine' ),
        'Merriweather' => __( 'Merriweather', 'vw-blog-magazine' ),
        'Monda' => __( 'Monda', 'vw-blog-magazine' ),
        'Montserrat' => __( 'Montserrat', 'vw-blog-magazine' ),
        'Muli' => __( 'Muli', 'vw-blog-magazine' ),
        'Marck Script' => __( 'Marck Script', 'vw-blog-magazine' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-blog-magazine' ),
        'Open Sans' => __( 'Open Sans', 'vw-blog-magazine' ),
        'Overpass' => __( 'Overpass', 'vw-blog-magazine' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-blog-magazine' ),
        'Oxygen' => __( 'Oxygen', 'vw-blog-magazine' ),
        'Orbitron' => __( 'Orbitron', 'vw-blog-magazine' ),
        'Patua One' => __( 'Patua One', 'vw-blog-magazine' ),
        'Pacifico' => __( 'Pacifico', 'vw-blog-magazine' ),
        'Padauk' => __( 'Padauk', 'vw-blog-magazine' ),
        'Playball' => __( 'Playball', 'vw-blog-magazine' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-blog-magazine' ),
        'PT Sans' => __( 'PT Sans', 'vw-blog-magazine' ),
        'Philosopher' => __( 'Philosopher', 'vw-blog-magazine' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-blog-magazine' ),
        'Poiret One' => __( 'Poiret One', 'vw-blog-magazine' ),
        'Quicksand' => __( 'Quicksand', 'vw-blog-magazine' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-blog-magazine' ),
        'Raleway' => __( 'Raleway', 'vw-blog-magazine' ),
        'Rubik' => __( 'Rubik', 'vw-blog-magazine' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-blog-magazine' ),
        'Russo One' => __( 'Russo One', 'vw-blog-magazine' ),
        'Righteous' => __( 'Righteous', 'vw-blog-magazine' ),
        'Slabo' => __( 'Slabo', 'vw-blog-magazine' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-blog-magazine' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-blog-magazine'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-blog-magazine' ),
        'Sacramento' => __( 'Sacramento', 'vw-blog-magazine' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-blog-magazine' ),
        'Tangerine' => __( 'Tangerine', 'vw-blog-magazine' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-blog-magazine' ),
        'VT323' => __( 'VT323', 'vw-blog-magazine' ),
        'Varela Round' => __( 'Varela Round', 'vw-blog-magazine' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-blog-magazine' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-blog-magazine' ),
        'Volkhov' => __( 'Volkhov', 'vw-blog-magazine' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-blog-magazine' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-blog-magazine' ),
			'100' => esc_html__( 'Thin',       'vw-blog-magazine' ),
			'300' => esc_html__( 'Light',      'vw-blog-magazine' ),
			'400' => esc_html__( 'Normal',     'vw-blog-magazine' ),
			'500' => esc_html__( 'Medium',     'vw-blog-magazine' ),
			'700' => esc_html__( 'Bold',       'vw-blog-magazine' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-blog-magazine' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-blog-magazine' ),
			'italic'  => esc_html__( 'Italic', 'vw-blog-magazine' ),
			'oblique' => esc_html__( 'Oblique', 'vw-blog-magazine' )
		);
	}
}
