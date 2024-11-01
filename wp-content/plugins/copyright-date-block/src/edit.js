/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

// this code is JSX 


import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	let  { startingYear } = attributes;
	let currentYear = new Date().getFullYear().toString();
	return ( // useBlockProps is a react Hook
	<>
		<InspectorControls>
			<PanelBody title= { __('Settings', 'copyright-date-block')}>
				Settings
			</PanelBody>
			<PanelBody title= { __('Settings', 'copyright-date-block')}>
				<TextControl 
					label = { __('Starting Year', 'copyright-date-block')}
					value = { startingYear }
					onChange = { ( newStartingYear ) => {
						setAttributes( { startingYear: newStartingYear } );
					} }
				/>
			</PanelBody>
		</InspectorControls>
		<p { ...useBlockProps() }> 
			{ __( // quick translation function __
				'Copyright',
				'copyright-date-block'
			) }
		 &copy; { startingYear } - { currentYear }
		</p>
		</>
	);
}
