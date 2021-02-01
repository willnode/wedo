<?php

namespace App\Controllers;

use App\Entities\Article;
use App\Entities\Barang;
use App\Entities\Penjualan;
use App\Entities\Review;
use App\Entities\Toko;
use App\Entities\User as EntitiesUser;
use App\Models\ArticleModel;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\ReviewModel;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Services;

class Admin extends BaseController
{

	/** @var EntitiesUser  */
	public $login;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		if (!($this->login = Services::login())) {
			$this->logout();
			$this->response->redirect('/login/')->send();
			exit;
		}
	}

	public function index()
	{
		return view('page/dashboard', [
			'page' => 'dashboard'
		]);
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect('/');
	}


	public function article($page = 'list', $id = null)
	{
		$model = new ArticleModel();
		if ($this->login->role !== 'admin') {
			$model->withUser($this->login->id);
		}
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/user/article/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/user/article/');
			}
		}
		switch ($page) {
			case 'list':
				return view('article/manage', [
					'data' => find_with_filter(empty($_GET['category']) ? $model : $model->withCategory($_GET['category'])),
					'page' => 'article',
				]);
			case 'add':
				return view('article/edit', [
					'item' => new Article()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('article/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function toko($page = 'list', $id = null)
	{
		$model = new TokoModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/toko/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/toko/');
			}
		}
		switch ($page) {
			case 'list':
				return view('toko/manage', [
					'data' => find_with_filter($model),
					'page' => 'toko',
				]);
			case 'add':
				return view('toko/edit', [
					'item' => new Toko()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('toko/edit', [
					'item' => $item
				]);
			case 'detail':
				return $this->response->redirect('/admin/barang/?toko_id=' . $id);
		}
		throw new PageNotFoundException();
	}

	public function barang($page = 'list', $id = null)
	{
		$model = new BarangModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/barang/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/barang/?toko_id=' . $_POST['toko_id'] ?? '');
			}
		}
		if (!empty($_GET['toko_id'])) {
			$model->withToko($_GET['toko_id']);
			$toko = (new TokoModel())->find($_GET['toko_id']);
		}
		switch ($page) {
			case 'list':
				return view('barang/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'barang',
				]);
			case 'add':
				return view('barang/edit', [
					'toko' => $toko ?? null,
					'item' => new Barang()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('barang/edit', [
					'toko' => $toko ?? $item->toko,
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function review($page = 'list', $id = null)
	{
		$model = new ReviewModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/review/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/review/?toko_id=' . $_POST['toko_id'] ?? '');
			}
		}
		if (!empty($_GET['toko_id'])) {
			$model->withToko($_GET['toko_id']);
			$toko = (new TokoModel())->find($_GET['toko_id']);
		}
		switch ($page) {
			case 'list':
				return view('review/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'review',
				]);
			case 'add':
				return view('review/edit', [
					'toko' => $toko ?? null,
					'item' => new Review()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('review/edit', [
					'toko' => $toko ?? $item->toko,
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function penjualan($page = 'list', $id = null)
	{
		$model = new PenjualanModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/penjualan/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/penjualan/?toko_id=' . $_POST['toko_id'] ?? '');
			}
		}
		if (!empty($_GET['toko_id'])) {
			$model->withToko($_GET['toko_id']);
			$toko = (new TokoModel())->find($_GET['toko_id']);
		}
		switch ($page) {
			case 'list':
				return view('penjualan/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'penjualan',
				]);
			case 'laporan':
				return view('penjualan/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'laporan',
				]);
			case 'add':
				return view('penjualan/edit', [
					'toko' => $toko ?? null,
					'item' => new Penjualan()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('penjualan/edit', [
					'toko' => $toko ?? $item->toko,
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function users($page = 'list', $id = null)
	{
		if ($this->login->role !== 'admin') {
			throw new PageNotFoundException();
		}
		$model = new UserModel();
		if ($this->request->getMethod() === 'post') {
			if ($page === 'delete' && $model->delete($id)) {
				return $this->response->redirect('/admin/users/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/users/');
			}
		}
		switch ($page) {
			case 'list':
				return view('users/manage', [
					'data' => find_with_filter($model),
					'page' => 'users',
				]);
			case 'add':
				return view('users/edit', [
					'item' => new EntitiesUser()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('users/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function uploads($directory)
	{
		$path = WRITEPATH . implode(DIRECTORY_SEPARATOR, ['uploads', $directory, '']);
		$r = $this->request;
		if (!is_dir($path))
			mkdir($path, 0775, true);
		if ($r->getMethod() === 'post') {
			if (($f = $r->getFile('file')) && $f->isValid()) {
				if ($f->move($path)) {
					return $f->getName();
				}
			}
		}
		return null;
	}

	public function profile()
	{
		if ($this->request->getMethod() === 'post') {
			if ((new UserModel())->processWeb($this->login->id)) {
				return $this->response->redirect('/user/profile/');
			}
		}
		return view('page/profile', [
			'item' => $this->login,
		]);
	}
}