/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.

	// config.toolbarGroups = [
	// 	{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
	// 	{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
	// 	{ name: 'links' },
	// 	{ name: 'insert' },
	// 	{ name: 'forms' },
	// 	{ name: 'tools' },
	// 	{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
	// 	{ name: 'others' },
	// 	'/',
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	// 	{ name: 'styles' },
	// 	{ name: 'colors' },
	// 	{ name: 'about' }
	// ];

	//standart toolbar configurations
	config.toolbar_Full =
	[
		{ name: 'styles',      items : [ 'Format' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike'] }, 
		{ name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Blockquote','-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight','JustifyBlock' ] },
		{ name: 'links',       items : [ 'Link','Unlink'] },
		{ name: 'insert',      items : [ 'Image','Table','HorizontalRule'] },
		{ name: 'clipboard',   items : [ 'Undo','Redo' ] },
		{ name: 'document',    items : [ 'Source' ] },
		{ name: 'editing' },
		{ name: 'forms' },
		{ name: 'colors' },
		{ name: 'tools' }
	];
	config.toolbar = 'Full';


	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	// config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.allowedContent = false;

	//wordcount configurations
	config.extraPlugins = 'wordcount, justify';
	config.wordcount = {
		showParagraphs: false,
		showWordCount: false,
		showCharCount: true,
		countHTML:true,
		maxCharCount:10000
	}

	//set the url of the upload file for photo's
	config.filebrowserUploadUrl = '/api/infoBlok/imageUpload.php';

	//set editor height
	config.height = 350; 

	
};
