<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Template as TemplateModel;
use CodeIgniter\Files\File;

class Template extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new TemplateModel();
		helper(['form', 'url', 'filesystem']);
	}

	/**
	 * Helper method to maintain compatibility with ResourceController respond method
	 */
	protected function respond($data, $status = 200)
	{
		return $this->response->setJSON($data)->setStatusCode($status);
	}

	/**
	 * Display theme management dashboard
	 */
	public function index()
	{
		$themes = $this->model->getAllThemes();
		$stats = $this->model->getThemeStats();
		$activeTheme = $this->model->getActiveTheme();

		$data = [
			'themes' => $themes,
			'stats' => $stats,
			'active_theme' => $activeTheme,
			'title' => 'Theme Management'
		];

		return view('cms/template/index', $data);
	}

	/**
	 * Show theme details and preview
	 */
	public function show($id = null)
	{
		$theme = $this->model->find($id);
		
		if (!$theme) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Theme not found');
		}

		$validation = $this->model->validateTheme($theme->folder);
		$canDelete = $this->model->canDeleteTheme($id);

		$data = [
			'theme' => $theme,
			'validation' => $validation,
			'can_delete' => $canDelete,
			'title' => 'Theme Details: ' . $theme->judul
		];

		return view('cms/template/show', $data);
	}

	/**
	 * Show theme upload/create form
	 */
	public function new()
	{
		$data = [
			'title' => 'Upload New Theme',
			'action' => 'create'
		];

		return view('cms/template/new', $data);
	}

	/**
	 * Handle theme upload and creation
	 */
	public function create()
	{
		$rules = [
			'judul' => 'required|min_length[3]|max_length[100]',
			'pembuat' => 'required|min_length[3]|max_length[100]',
			'folder' => 'required|min_length[3]|max_length[50]|alpha_dash|is_unique[templates.folder]',
			'description' => 'permit_empty|max_length[500]',
			'version' => 'permit_empty|max_length[20]'
		];

		if (!$this->validate($rules)) {
			return $this->respond([
				'success' => false,
				'errors' => $this->validator->getErrors()
			], 400);
		}

		$data = [
			'judul' => $this->request->getPost('judul'),
			'pembuat' => $this->request->getPost('pembuat'),
			'folder' => $this->request->getPost('folder'),
			'description' => $this->request->getPost('description'),
			'version' => $this->request->getPost('version') ?: '1.0.0',
			'aktif' => 'N',
			'created_by' => session()->get('cms.id')
		];

		// Handle file upload if provided
		$file = $this->request->getFile('theme_file');
		if ($file && $file->isValid()) {
			$uploadResult = $this->handleThemeUpload($file, $data['folder']);
			if (!$uploadResult['success']) {
				return $this->respond([
					'success' => false,
					'message' => $uploadResult['message']
				], 400);
			}
		}

		// Handle thumbnail upload
		$thumbnail = $this->request->getFile('thumbnail');
		if ($thumbnail && $thumbnail->isValid()) {
			$thumbnailResult = $this->handleThumbnailUpload($thumbnail, $data['folder']);
			if ($thumbnailResult['success']) {
				$data['thumbnail'] = $thumbnailResult['filename'];
			}
		}

		if ($this->model->insert($data)) {
			return $this->respond([
				'success' => true,
				'message' => 'Theme created successfully',
				'data' => $data
			]);
		} else {
			return $this->respond([
				'success' => false,
				'message' => 'Failed to create theme'
			], 500);
		}
	}

	/**
	 * Show theme edit form
	 */
	public function edit($id = null)
	{
		$theme = $this->model->find($id);
		
		if (!$theme) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Theme not found');
		}

		$data = [
			'theme' => $theme,
			'title' => 'Edit Theme: ' . $theme->judul,
			'action' => 'update'
		];

		return view('cms/template/edit', $data);
	}

	/**
	 * Update theme information
	 */
	public function update($id = null)
	{
		try {
			// Set response format to JSON
			$this->response->setContentType('application/json');
			
			// Debug: Log the request to see if it's reaching here
			log_message('info', 'Theme update request for ID: ' . $id);
			log_message('info', 'POST data: ' . json_encode($this->request->getPost()));
			
			$theme = $this->model->find($id);
			
			if (!$theme) {
				log_message('error', 'Theme not found with ID: ' . $id);
				return $this->response->setJSON([
					'success' => false,
					'message' => 'Theme not found'
				])->setStatusCode(404);
			}

			$rules = [
				'judul' => 'required|min_length[3]|max_length[100]',
				'pembuat' => 'required|min_length[3]|max_length[100]',
				'description' => 'permit_empty|max_length[500]',
				'version' => 'permit_empty|max_length[20]'
			];

			if (!$this->validate($rules)) {
				log_message('error', 'Validation failed: ' . json_encode($this->validator->getErrors()));
				return $this->response->setJSON([
					'success' => false,
					'errors' => $this->validator->getErrors()
				])->setStatusCode(400);
			}

			$data = [
				'judul' => $this->request->getPost('judul'),
				'pembuat' => $this->request->getPost('pembuat'),
				'description' => $this->request->getPost('description'),
				'version' => $this->request->getPost('version') ?: '1.0.0'
			];

			// Handle thumbnail upload
			$thumbnail = $this->request->getFile('thumbnail');
			if ($thumbnail && $thumbnail->isValid()) {
				log_message('info', 'Processing thumbnail upload');
				$thumbnailResult = $this->handleThumbnailUpload($thumbnail, $theme->folder);
				if ($thumbnailResult['success']) {
					$data['thumbnail'] = $thumbnailResult['filename'];
					log_message('info', 'Thumbnail uploaded successfully: ' . $thumbnailResult['filename']);
				} else {
					log_message('error', 'Thumbnail upload failed: ' . $thumbnailResult['message']);
				}
			}

			log_message('info', 'Updating theme with data: ' . json_encode($data));
			
			if ($this->model->update($id, $data)) {
				log_message('info', 'Theme updated successfully');
				return $this->response->setJSON([
					'success' => true,
					'message' => 'Theme updated successfully'
				]);
			} else {
				log_message('error', 'Database update failed for theme ID: ' . $id);
				return $this->response->setJSON([
					'success' => false,
					'message' => 'Failed to update theme'
				])->setStatusCode(500);
			}
		} catch (\Exception $e) {
			log_message('error', 'Exception in theme update: ' . $e->getMessage());
			log_message('error', 'Stack trace: ' . $e->getTraceAsString());
			
			return $this->response->setJSON([
				'success' => false,
				'message' => 'An error occurred: ' . $e->getMessage()
			])->setStatusCode(500);
		}
	}

	/**
	 * Delete theme
	 */
	public function delete($id = null)
	{
		$theme = $this->model->find($id);
		
		if (!$theme) {
			return $this->respond([
				'success' => false,
				'message' => 'Theme not found'
			], 404);
		}

		$canDelete = $this->model->canDeleteTheme($id);
		if (!$canDelete['can_delete']) {
			return $this->respond([
				'success' => false,
				'message' => $canDelete['reason']
			], 400);
		}

		// Delete theme files
		$fileDeleteResult = $this->model->deleteThemeFiles($theme->folder);
		
		// Delete from database
		if ($this->model->delete($id)) {
			return $this->respond([
				'success' => true,
				'message' => 'Theme deleted successfully',
				'file_deletion' => $fileDeleteResult
			]);
		} else {
			return $this->respond([
				'success' => false,
				'message' => 'Failed to delete theme from database'
			], 500);
		}
	}

	/**
	 * Activate theme
	 */
	public function activate($id = null)
	{
		// Set response format to JSON
		$this->response->setContentType('application/json');
		
		// Debug: Log the request to see if it's reaching here
		log_message('info', 'Theme activation request for ID: ' . $id);
		log_message('info', 'Session data: ' . json_encode(session()->get()));
		
		$theme = $this->model->find($id);
		
		if (!$theme) {
			return $this->response->setJSON([
				'success' => false,
				'message' => 'Theme not found'
			])->setStatusCode(404);
		}

		// Validate theme structure before activation
		$validation = $this->model->validateTheme($theme->folder);
		if (!$validation['valid']) {
			return $this->response->setJSON([
				'success' => false,
				'message' => 'Cannot activate theme: ' . $validation['error']
			])->setStatusCode(400);
		}

		if ($this->model->activateTheme($id)) {
			return $this->response->setJSON([
				'success' => true,
				'message' => 'Theme activated successfully'
			]);
		} else {
			return $this->response->setJSON([
				'success' => false,
				'message' => 'Failed to activate theme'
			])->setStatusCode(500);
		}
	}

	/**
	 * Export theme as JSON
	 */
	public function export($id = null)
	{
		$theme = $this->model->find($id);
		
		if (!$theme) {
			return $this->respond([
				'success' => false,
				'message' => 'Theme not found'
			], 404);
		}

		$jsonData = $this->model->exportTheme($id);
		
		if ($jsonData === false) {
			return $this->respond([
				'success' => false,
				'message' => 'Failed to export theme'
			], 500);
		}

		$filename = 'theme_' . $theme->folder . '_' . date('Y-m-d_H-i-s') . '.json';

		return $this->response
			->setHeader('Content-Type', 'application/json')
			->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
			->setBody($jsonData);
	}

	/**
	 * Show import form
	 */
	public function import()
	{
		$data = [
			'title' => 'Import Theme from JSON'
		];

		return view('cms/template/import', $data);
	}

	/**
	 * Handle theme import from JSON
	 */
	public function doImport()
	{
		$rules = [
			'json_file' => 'uploaded[json_file]|ext_in[json_file,json]|max_size[json_file,2048]'
		];

		if (!$this->validate($rules)) {
			return $this->respond([
				'success' => false,
				'errors' => $this->validator->getErrors()
			], 400);
		}

		$file = $this->request->getFile('json_file');
		
		if (!$file->isValid()) {
			return $this->respond([
				'success' => false,
				'message' => 'Invalid file upload'
			], 400);
		}

		$jsonContent = file_get_contents($file->getTempName());
		$userId = session()->get('cms.id');

		$result = $this->model->importTheme($jsonContent, $userId);

		return $this->respond($result);
	}

	/**
	 * Preview theme
	 */
	public function preview($id = null)
	{
		$theme = $this->model->find($id);
		
		if (!$theme) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Theme not found');
		}

		// Store current theme in session for restoration
		$currentTheme = $this->model->getActiveTheme();
		session()->setTempdata('preview_original_theme', $currentTheme->id, 3600);
		session()->setTempdata('preview_theme', $theme->folder, 3600);

		// Redirect to homepage with preview theme
		return redirect()->to('/?preview=' . $theme->id);
	}

	/**
	 * Handle theme file upload
	 */
	private function handleThemeUpload($file, $folder)
	{
		$allowedTypes = ['zip'];
		$maxSize = 50 * 1024 * 1024; // 50MB

		if (!in_array($file->getExtension(), $allowedTypes)) {
			return ['success' => false, 'message' => 'Only ZIP files are allowed'];
		}

		if ($file->getSize() > $maxSize) {
			return ['success' => false, 'message' => 'File size too large (max 50MB)'];
		}

		$uploadPath = WRITEPATH . 'uploads/themes/';
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0755, true);
		}

		$filename = $folder . '_' . time() . '.zip';
		
		if ($file->move($uploadPath, $filename)) {
			// Extract ZIP file
			$extractResult = $this->extractThemeZip($uploadPath . $filename, $folder);
			
			// Clean up ZIP file
			unlink($uploadPath . $filename);
			
			return $extractResult;
		}

		return ['success' => false, 'message' => 'Failed to upload file'];
	}

	/**
	 * Extract theme ZIP file
	 */
	private function extractThemeZip($zipPath, $folder)
	{
		$zip = new \ZipArchive();
		
		if ($zip->open($zipPath) !== TRUE) {
			return ['success' => false, 'message' => 'Cannot open ZIP file'];
		}

		$viewsPath = APPPATH . 'Views/themes/' . $folder . '/';
		$assetsPath = FCPATH . 'themes/' . $folder . '/';

		// Create directories
		if (!is_dir($viewsPath)) {
			mkdir($viewsPath, 0755, true);
		}
		if (!is_dir($assetsPath)) {
			mkdir($assetsPath, 0755, true);
		}

		// Extract files
		for ($i = 0; $i < $zip->numFiles; $i++) {
			$filename = $zip->getNameIndex($i);
			
			// Determine destination based on file type
			if (pathinfo($filename, PATHINFO_EXTENSION) === 'php') {
				$destination = $viewsPath . basename($filename);
			} else {
				$destination = $assetsPath . $filename;
			}

			// Create subdirectories if needed
			$dir = dirname($destination);
			if (!is_dir($dir)) {
				mkdir($dir, 0755, true);
			}

			// Extract file
			copy("zip://" . $zipPath . "#" . $filename, $destination);
		}

		$zip->close();

		return ['success' => true, 'message' => 'Theme extracted successfully'];
	}

	/**
	 * Handle thumbnail upload
	 */
	private function handleThumbnailUpload($file, $folder)
	{
		$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
		$maxSize = 5 * 1024 * 1024; // 5MB

		if (!in_array($file->getExtension(), $allowedTypes)) {
			return ['success' => false, 'message' => 'Invalid thumbnail format'];
		}

		if ($file->getSize() > $maxSize) {
			return ['success' => false, 'message' => 'Thumbnail file too large'];
		}

		$uploadPath = FCPATH . 'themes/' . $folder . '/';
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0755, true);
		}

		$filename = 'thumbnail.' . $file->getExtension();
		
		if ($file->move($uploadPath, $filename)) {
			return ['success' => true, 'filename' => $filename];
		}

		return ['success' => false, 'message' => 'Failed to upload thumbnail'];
	}

	/**
	 * Search themes
	 */
	public function search()
	{
		$keyword = $this->request->getGet('q');
		
		if (empty($keyword)) {
			return $this->respond([
				'success' => false,
				'message' => 'Search keyword required'
			], 400);
		}

		$themes = $this->model->searchThemes($keyword);

		return $this->respond([
			'success' => true,
			'data' => $themes,
			'count' => count($themes)
		]);
	}
}
