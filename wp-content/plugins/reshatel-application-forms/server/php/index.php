<?php
global $wpdb;

$options = array(
	'delete_type' => 'POST',
	'db_host' => DB_HOST,
	'db_user' => DB_USER,
	'db_pass' => DB_PASSWORD,
	'db_name' => DB_NAME,
	'db_table' => RE_TABLE_FILES
);

error_reporting(E_ALL | E_STRICT);
//mysqli_report(MYSQLI_REPORT_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

	protected function initialize() {
		$this->db = new mysqli(
			$this->options['db_host'],
			$this->options['db_user'],
			$this->options['db_pass'],
			$this->options['db_name']
		);
		parent::initialize();
		$this->db->close();
	}

	protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
		$index = null, $content_range = null) {
		$file = parent::handle_file_upload(
			$uploaded_file, $name, $size, $type, $error, $index, $content_range
		);
		if (empty($file->error)) {
			$time = time();
			$sql = 'INSERT INTO `'.$this->options['db_table']
			       .'` (`name`, `size`, `type`, `time_download` )'
			       .' VALUES (?, ?, ?, ?)';
			$query = $this->db->prepare($sql);
			$query->bind_param(
				'sisi',
				$file->name,
				$file->size,
				$file->type,
				$time
			);
			$query->execute();
			$file->fileId = $this->db->insert_id;
			$file->file = $file->name;
		}
		return $file;
	}

	public function generate_response($content, $print_response = true) {
		if( count($content['files']) == 0 ) {
			echo 'Ошибка';
		}
		parent::generate_response($content['files'][0]);
	}
}

$upload_handler = new CustomUploadHandler($options);
