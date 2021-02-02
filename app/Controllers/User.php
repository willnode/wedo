<?php

namespace App\Controllers;

use App\Entities\Article;
use App\Entities\User as EntitiesUser;
use App\Models\ArticleModel;
use App\Models\BarangModel;
use App\Models\CartModel;
use App\Models\PenjualanModel;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Database;
use Config\Services;

class User extends BaseController
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
		return $this->response->redirect('/user/toko/');
	}

	public function toko($page = 'list', $id = null)
	{
		$model = new TokoModel();
		switch ($page) {
			case 'list':
				return view('belanja/toko/list', [
					'page' => 'toko',
					'data' => find_with_filter($model),
				]);
			case 'view':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('belanja/toko/view', [
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
				return view('belanja/barang/view', [
					'item' => $item
				]);
		}
		throw new PageNotFoundException();
	}

	public function cart($page = 'list')
	{
		$model = new CartModel();
		if ($this->request->getMethod() == 'post') {
			$_POST['user_id'] = $this->login->id;
			switch ($page) {
				case 'add':
					try {
						$model->processWeb(null);
					} catch (\Throwable $th) {
						$g = $model->with([
							'user_id' => 	$_POST['user_id'],
							'barang_id' => 	$_POST['barang_id'],
						])->findAll()[0];
						$g->qty += $_POST['qty'];
						$model->save($g);
					}
					return $this->response->redirect($_POST['r'] ?? previous_url());
				case 'set':
					$g = $model->with([
						'user_id' => 	$_POST['user_id'],
						'barang_id' => 	$_POST['barang_id'],
					])->findAll()[0];
					$g->qty = $_POST['qty'];
					$model->save($g);
					return $this->response->redirect($_POST['r'] ?? previous_url());
				case 'delete':
					$model->with([
						'user_id' => 	$_POST['user_id'],
						'barang_id' => 	$_POST['barang_id'],
					])->delete();
					return $this->response->redirect($_POST['r'] ?? previous_url());
				case 'checkout':
					$g = $model->with([
						'user_id' => 	$_POST['user_id'],
					])->findAll();
					$c = PenjualanModel::makePenjualan($g, $_POST['user_id']);
					$model->with([
						'user_id' => 	$_POST['user_id'],
					])->delete();
					(new PenjualanModel())->save($c);
					return $this->response->redirect('/user/history/view/' . Database::connect()->insertID());
			}
		}
		switch ($page) {
			case 'list':
				return view('belanja/cart/view', [
					'page' => 'cart',
				]);
		}
	}

	public function history($page = 'list', $id = null)
	{
		$model = new PenjualanModel();
		$model->withUser($this->login->id);
		switch ($page) {
			case 'list':
				return view('belanja/history/list', [
					'data' => find_with_filter($model),
					'page' => 'history',
				]);
			case 'view':
				if (!($item = $model->find($id))) {
					throw new PageNotFoundException();
				}
				return view('belanja/history/view', [
					'item' => $item,
					'page' => 'history',
				]);
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return $this->response->redirect('/');
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
