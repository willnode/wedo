<?php

namespace App\Controllers;

use App\Entities\Article;
use App\Entities\Barang;
use App\Entities\Cart;
use App\Entities\Config;
use App\Entities\Penjualan;
use App\Entities\Review;
use App\Entities\Toko;
use App\Entities\User as EntitiesUser;
use App\Libraries\PenjualanProcessor;
use App\Models\ArticleModel;
use App\Models\BarangModel;
use App\Models\CartModel;
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
		return $this->response->redirect('/admin/penjualan/');
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
				return $this->response->redirect('/admin/article/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/article/');
			}
		}
		switch ($page) {
			case 'list':
				return view('admin/article/manage', [
					'data' => find_with_filter(empty($_GET['category']) ? $model : $model->withCategory($_GET['category'])),
					'page' => 'article',
				]);
			case 'add':
				return view('admin/article/edit', [
					'item' => new Article()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/article/edit', [
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
				(new BarangModel())->withToko($id)->delete();
				return $this->response->redirect('/admin/toko/');
			} else if ($id = $model->processWeb($id)) {
				return $this->response->redirect('/admin/toko/');
			}
		}
		switch ($page) {
			case 'open':
				return $this->response->redirect('/toko/view/' . $id);
			case 'barang':
				return $this->response->redirect('/admin/barang/?toko_id=' . $id);
			case 'list':
				return view('admin/toko/manage', [
					'data' => find_with_filter($model),
					'page' => 'toko',
				]);
			case 'add':
				return view('admin/toko/edit', [
					'item' => new Toko()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/toko/edit', [
					'item' => $item
				]);
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
			case 'review':
				return $this->response->redirect('/admin/review/?toko_id=' . $id);
			case 'open':
				return $this->response->redirect('/barang/view/' . $id);
			case 'list':
				return view('admin/barang/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'barang',
				]);
			case 'add':
				return view('admin/barang/edit', [
					'toko' => $toko ?? null,
					'item' => new Barang()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/barang/edit', [
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
				return $this->response->redirect('/admin/review/');
			}
		}
		if (!empty($_GET['toko_id'])) {
			$model->withToko($_GET['toko_id']);
			$toko = (new TokoModel())->find($_GET['toko_id']);
		}
		switch ($page) {
			case 'list':
				return view('admin/review/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'review',
				]);
			case 'delete':
				$model->delete($id);
				return $this->response->redirect('/admin/review/');
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
				return $this->response->redirect('/admin/penjualan/detail/' . $id);
			}
		}
		switch ($page) {
			case 'list':
				if ($_GET['archive'] ?? '') {
					$model->with('status IN ("diterima", "dibatalkan")');
				} else {
					$model->with('status IN ("menunggu", "diproses")');
				}
				return view('admin/penjualan/manage', [
					'data' => find_with_filter($model),
					'toko' => $toko ?? null,
					'page' => 'penjualan',
				]);
			case 'laporan':
				return view('admin/penjualan/laporan', [
					'page' => 'laporan',
					'data' => $model->aggregate(),
				]);
			case 'export':
				(new PenjualanProcessor)->exportAndSend($model->findAll());
			case 'wa':
				/** @var Penjualan $item */
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return $this->response->redirect('https://wa.me/?' . http_build_query([
					'text' =>
					"-------------------------------- \n" .
						"{$item->created_at->toLocalizedString('dd/MM/yyyy HH:mm')} WIB\n" .
						"-------------------------------- \n" .
						"Nomor Nota:\n" . date('y') . sprintf('%03d', $item->id) . "\n\n" .
						"Daftar Belanja:\n" . implode("\n", array_map(function ($x, $i) {
							/** @var Cart $x */
							$barang = $x->barang;
							$toko = (new TokoModel)->find($barang->toko_id)->nama ?? '';
							return ($i + 1) . ". \n{$barang->nama}\n {$toko}" .
								"\n Jumlah : {$x->qty} pcs" .
								"\n Harga (@) : " . rupiah($barang->harga) .
								"\n Total Harga : " . rupiah($barang->harga * $x->qty) .
								"\n\n";
						}, $item->nota, array_keys($item->nota))) .
						"Sub Total: " . rupiah(CartModel::getTotal($item->nota)) .
						"\nOngkos Kirim: " . $item->rpOngkir .
						"\nTotal Belanja: {$item->rpTotal}\n" .
						"-------------------------------- \n" .
						"Nama:\n {$item->nama} ({$item->hp})\n" .
						"Alamat:\n {$item->alamat}\n\n" .
						"INI ADALAH HARGA KHUSUS APABILA MEMESAN VIA WEDO\n" .
						"          wedoprb.com\n" .
						"-------------------------------- \n" .
						"*We Do What You Need*"
				]));
			case 'maps':
				/** @var Penjualan $item */
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return $this->response->redirect('https://maps.google.com/?q=' . urlencode($item->user->alamat));
			case 'detail':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/penjualan/view', [
					'item' => $item,
					'page' => 'penjualan',
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
				return view('admin/users/manage', [
					'data' => find_with_filter($model),
					'page' => 'users',
				]);
			case 'add':
				return view('admin/users/edit', [
					'item' => new EntitiesUser()
				]);
			case 'edit':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('admin/users/edit', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function config()
	{
		if ($this->request->getMethod() == 'post') {
			$c = Config::get();
			$c->fill($_POST);
			post_files($c, 'banner');
			$c->save();
			return $this->response->redirect('/admin/config');
		}
		return view('admin/config', [
			'page' => 'config',
			'item' => Config::get(),
		]);
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
				return $this->response->redirect('/admin/profile/');
			}
		}
		return view('page/profile', [
			'item' => $this->login,
		]);
	}
}
