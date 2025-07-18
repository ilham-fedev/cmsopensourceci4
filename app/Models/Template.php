<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Files\File;

class Template extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'templates';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['judul','pembuat','folder','aktif','created_by','description','version','thumbnail','settings'];

	// Dates
	protected $useTimestamps        = true;

	/**
	 * Get the currently active theme
	 */
	public function getActiveTheme()
	{
		return $this->where('aktif', 'Y')->first();
	}

	/**
	 * Get all available themes
	 */
	public function getAllThemes()
	{
		return $this->orderBy('created_at', 'DESC')->findAll();
	}

	/**
	 * Activate a theme (deactivate others)
	 */
	public function activateTheme($id)
	{
		$db = \Config\Database::connect();
		$db->transStart();

		try {
			// Deactivate all themes
			$this->set('aktif', 'N')->where('aktif', 'Y')->update();
			
			// Activate selected theme
			$result = $this->update($id, ['aktif' => 'Y']);
			
			$db->transComplete();
			
			if ($db->transStatus() === false) {
				return false;
			}
			
			// Clear theme cache
			if (session()->has('active_themes')) {
				session()->remove('active_themes');
			}
			if (session()->has('active_theme')) {
				session()->remove('active_theme');
			}
			
			return $result;
		} catch (\Exception $e) {
			$db->transRollback();
			log_message('error', 'Theme activation failed: ' . $e->getMessage());
			return false;
		}
	}

	/**
	 * Validate theme structure
	 */
	public function validateTheme($themePath)
	{
		$requiredFiles = [
			'_layout.php',
			'home.php'
		];

		$requiredDirs = [
			'views' => APPPATH . 'Views/themes/' . $themePath,
			'assets' => FCPATH . 'themes/' . $themePath
		];

		// Check if required directories exist
		foreach ($requiredDirs as $type => $path) {
			if (!is_dir($path)) {
				return [
					'valid' => false,
					'error' => "Missing {$type} directory: {$path}"
				];
			}
		}

		// Check if required view files exist
		$viewPath = APPPATH . 'Views/themes/' . $themePath . '/';
		foreach ($requiredFiles as $file) {
			if (!file_exists($viewPath . $file)) {
				return [
					'valid' => false,
					'error' => "Missing required file: {$file}"
				];
			}
		}

		return ['valid' => true];
	}

	/**
	 * Export theme data as JSON
	 */
	public function exportTheme($id)
	{
		$theme = $this->find($id);
		if (!$theme) {
			return false;
		}

		$themeData = [
			'theme' => [
				'name' => $theme->judul,
				'author' => $theme->pembuat,
				'folder' => $theme->folder,
				'description' => $theme->description ?? '',
				'version' => $theme->version ?? '1.0.0',
				'active' => $theme->aktif === 'Y',
				'metadata' => [
					'created_at' => $theme->created_at,
					'updated_at' => $theme->updated_at,
					'thumbnail' => $theme->thumbnail ?? null
				],
				'settings' => json_decode($theme->settings ?? '{}', true),
				'export_date' => date('Y-m-d H:i:s'),
				'export_version' => '1.0'
			]
		];

		return json_encode($themeData, JSON_PRETTY_PRINT);
	}

	/**
	 * Import theme from JSON data
	 */
	public function importTheme($jsonData, $userId = null)
	{
		try {
			$data = json_decode($jsonData, true);
			
			if (!isset($data['theme'])) {
				return ['success' => false, 'error' => 'Invalid theme JSON format'];
			}

			$theme = $data['theme'];
			
			// Check if theme folder already exists
			$existing = $this->where('folder', $theme['folder'])->first();
			if ($existing) {
				return ['success' => false, 'error' => 'Theme folder already exists: ' . $theme['folder']];
			}

			// Prepare theme data for insertion
			$themeData = [
				'judul' => $theme['name'],
				'pembuat' => $theme['author'],
				'folder' => $theme['folder'],
				'description' => $theme['description'] ?? '',
				'version' => $theme['version'] ?? '1.0.0',
				'aktif' => 'N', // Don't auto-activate imported themes
				'settings' => json_encode($theme['settings'] ?? []),
				'thumbnail' => $theme['metadata']['thumbnail'] ?? null,
				'created_by' => $userId
			];

			$result = $this->insert($themeData);
			
			if ($result) {
				return ['success' => true, 'id' => $this->getInsertID()];
			} else {
				return ['success' => false, 'error' => 'Failed to insert theme data'];
			}

		} catch (\Exception $e) {
			log_message('error', 'Theme import failed: ' . $e->getMessage());
			return ['success' => false, 'error' => 'Import failed: ' . $e->getMessage()];
		}
	}

	/**
	 * Get theme statistics
	 */
	public function getThemeStats()
	{
		return [
			'total' => $this->countAll(),
			'active' => $this->where('aktif', 'Y')->countAllResults(),
			'inactive' => $this->where('aktif', 'N')->countAllResults()
		];
	}

	/**
	 * Search themes
	 */
	public function searchThemes($keyword)
	{
		return $this->groupStart()
					->like('judul', $keyword)
					->orLike('pembuat', $keyword)
					->orLike('description', $keyword)
					->groupEnd()
					->findAll();
	}

	/**
	 * Check if theme can be safely deleted
	 */
	public function canDeleteTheme($id)
	{
		$theme = $this->find($id);
		if (!$theme) {
			return ['can_delete' => false, 'reason' => 'Theme not found'];
		}

		if ($theme->aktif === 'Y') {
			return ['can_delete' => false, 'reason' => 'Cannot delete active theme'];
		}

		return ['can_delete' => true];
	}

	/**
	 * Get theme file paths
	 */
	public function getThemePaths($folder)
	{
		return [
			'views' => APPPATH . 'Views/themes/' . $folder,
			'assets' => FCPATH . 'themes/' . $folder,
			'uploads' => WRITEPATH . 'uploads/themes/' . $folder
		];
	}

	/**
	 * Delete theme files
	 */
	public function deleteThemeFiles($folder)
	{
		$paths = $this->getThemePaths($folder);
		$deleted = [];
		$errors = [];

		foreach ($paths as $type => $path) {
			if (is_dir($path)) {
				if ($this->deleteDirectory($path)) {
					$deleted[] = $type;
				} else {
					$errors[] = "Failed to delete {$type} directory: {$path}";
				}
			}
		}

		return [
			'deleted' => $deleted,
			'errors' => $errors,
			'success' => empty($errors)
		];
	}

	/**
	 * Recursively delete directory
	 */
	private function deleteDirectory($dir)
	{
		if (!is_dir($dir)) {
			return true;
		}

		$files = array_diff(scandir($dir), ['.', '..']);
		
		foreach ($files as $file) {
			$path = $dir . DIRECTORY_SEPARATOR . $file;
			if (is_dir($path)) {
				$this->deleteDirectory($path);
			} else {
				unlink($path);
			}
		}

		return rmdir($dir);
	}
}
