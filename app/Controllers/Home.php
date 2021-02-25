<?php

namespace App\Controllers;

use App\Entities\Cart;
use App\Entities\Config;
use App\Entities\Review;
use App\Libraries\CartProcessor;
use App\Models\ArticleModel;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\ReviewModel;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\Exceptions\FileNotFoundException;
use Config\Database;
use Config\Services;

class Home extends BaseController
{
	public function index()
	{
		return view('page/home', [
			'news' => find_with_filter((new ArticleModel())->withCategory('news'), 2),
			'info' => find_with_filter((new ArticleModel())->withCategory('info'), 2),
			'page' => 'home',
		]);
	}

	public function custom()
	{
		return $this->response->redirect(HP2WA(Config::get()->whatsapp));
	}

	public function feedback()
	{
		return $this->response->redirect(Config::get()->feedback);
	}

	public function login()
	{
		if ($r = $this->request->getGet('r')) {
			return $this->response->setCookie('r', $r, 0)->redirect('/login/');
		}
		if ($this->request->getMethod() === 'post') {
			$post = $this->request->getPost();
			if (isset($post['nohp'], $post['password'])) {
				$login = (new UserModel())->atEmail($post['nohp']);
				if ($login && password_verify(
					$post['password'],
					$login->password
				)) {
					(new UserModel())->login($login);
					if ($r = $this->request->getCookie('r')) {
						$this->response->deleteCookie('r');
					}
					return $this->response->redirect(base_url('admin'));
				}
			}
			$m = lang('Interface.wrongLogin');
		}
		return view('page/login', [
			'message' => $m ?? (($_GET['msg'] ?? '') === 'emailsent' ? lang('Interface.emailSent') : null)
		]);
	}

	public function article($id = null)
	{
		if ($id === 'about') $id = 1;
		else if ($id === 'faq') $id = 2;
		else if ($id === 'contact') $id = 3;

		$model = new ArticleModel();
		if ($id === null) {
			return view('article/list', [
				'data' => $model->findAll(),
			]);
		} else if ($item = $model->find($id)) {
			return view('article/view', [
				'item' => $item
			]);
		} else {
			throw new PageNotFoundException();
		}
	}

	public function toko($page = 'list', $id = null)
	{
		$model = new TokoModel();
		switch ($page) {
			case 'list':
				return view('user/toko/list', [
					'page' => 'toko',
					'data' => find_with_filter($model),
				]);
			case 'view':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('user/toko/view', [
					'item' => $item
				]);
		}
	}

	public function barang($page = 'view', $id = null)
	{
		$model = new BarangModel();
		switch ($page) {
			case 'view':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('user/barang/view', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function cart($page = 'list')
	{
		if ($this->request->getMethod() == 'post') {
			switch ($page) {
				case 'add':
					$g = CartProcessor::find($_POST['barang_id']);
					if (!$g) {
						CartProcessor::add($g = new Cart($_POST));
					}
					$g->qty += $_POST['qty'];
					CartProcessor::save();
					return $this->response->redirect($_POST['r'] ?? previous_url());
				case 'set':
					$g = CartProcessor::find($_POST['barang_id']);
					$g->qty = $_POST['qty'];
					CartProcessor::save();
					return $this->response->redirect($_POST['r'] ?? previous_url());
				case 'delete':
					CartProcessor::delete($_POST['barang_id']);
					CartProcessor::save();
					return $this->response->redirect($_POST['r'] ?? previous_url());
				case 'checkout':
					$g = CartProcessor::load();
					$c = PenjualanModel::makePenjualan($g, $_POST);
					CartProcessor::delete();
					CartProcessor::save();
					(new PenjualanModel())->save($c);
					return $this->response->redirect('/history/view/' . Database::connect()->insertID());
			}
		}
		switch ($page) {
			case 'list':
				return view('user/cart/view', [
					'page' => 'cart',
				]);
		}
	}

	public function history($page = 'list', $id = null)
	{
		$model = new PenjualanModel();
		$model->withUser($_SESSION['hp'] ?? '');
		if ($this->request->getMethod() == 'post') {
			$m = new ReviewModel();
			$r = new Review($_POST);
			$r->id = null;
			$r->hp = $_SESSION['hp'] ?? '';
			$r->nama = $_SESSION['nama'] ?? '';
			$r->created_at = date('Y-m-d H:i:s');
			$r->updated_at = date('Y-m-d H:i:s');
			$m->replace($r->toArray());
			return $this->response->redirect('/history/view/' . $id);
		}
		switch ($page) {
			case 'list':
				return view('user/history/list', [
					'data' => find_with_filter($model),
					'page' => 'history',
				]);
			case 'view':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('user/history/view', [
					'item' => $item,
					'page' => 'history',
				]);
		}
	}

	public function logout()
	{
		Services::session()->destroy();
		return $this->response->redirect('/');
	}

	public function uploads($directory, $file)
	{
		$path = WRITEPATH . implode(DIRECTORY_SEPARATOR, ['uploads', $directory, $file]);
		if ($file && is_file($path)) {
			$last_modified_time = filemtime($path);
			$etag = md5_file($path);
			header("Last-Modified: " . gmdate("D, d M Y H:i:s", $last_modified_time) . " GMT");
			header("Etag: $etag");
			header("Cache-Control: public");
			header_remove('Pragma');
			if (
				strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '') == $last_modified_time ||
				trim($_SERVER['HTTP_IF_NONE_MATCH'] ?? '') == $etag
			) {
				header("HTTP/1.1 304 Not Modified");
				exit;
			}
			header('Content-Type: ' . mime_content_type($path));
			header('Content-Length: ' . filesize($path));
			readfile($path);
			exit;
		}
		throw new FileNotFoundException();
	}
}
