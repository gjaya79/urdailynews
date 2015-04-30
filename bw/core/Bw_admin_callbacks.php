<?php

class Bw_admin_callbacks {
	
	static $funcs = array(
		'import_sample_data',
		'bw_gallery_preview'
	);
	
	static function import_sample_data() {
		
		die( Bw_import::init() );
		
	}
	
	static function bw_gallery_preview() {
		
		$result = array('success' => false, 'output' => '');
		
		$ids = isset( $_REQUEST['attachments_ids'] ) ? $_REQUEST['attachments_ids'] : null;
		
		if ( empty($ids) ) {
			echo json_encode( $result );
			exit;
		}

		$ids = explode( ',', $ids );

		foreach ( $ids as $id ) {
			$attach = wp_get_attachment_image_src( $id, 'thumbnail', false);
			$result["output"] .= '<li><img src="'.$attach[0] .'" /></li>';
		}
		$result["success"] = true;
		echo json_encode( $result );
		exit;
		
	}
}

?>