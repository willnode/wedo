<?php

namespace App\Controllers;

use App\Libraries\Recaptha;
use App\Models\ArticleModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\Exceptions\FileNotFoundException;

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

	public function login()
	{
		if ($this->session->has('login')) {
			return $this->response->redirect('/user/');
		}
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
					return $this->response->redirect(base_url($login->role));
				}
			}
			$m = lang('Interface.wrongLogin');
		}
		return view('page/login', [
			'message' => $m ?? (($_GET['msg'] ?? '') === 'emailsent' ? lang('Interface.emailSent') : null)
		]);
	}

	public function register()
	{
		$recaptha = new Recaptha();
		if ($this->request->getMethod() === 'get') {
			return view('page/register', [
				'errors' => $this->session->errors,
				'recapthaSite' => $recaptha->recapthaSite,
			]);
		} else {
			if ($this->validate([
				'name' => 'required|min_length[3]|max_length[255]',
				'nohp' => 'required|is_unique[user.nohp]',
				'password' => 'required|min_length[8]',
				'g-recaptcha-response' => ENVIRONMENT === 'production' && $recaptha->recapthaSecret ? 'required' : 'permit_empty',
			])) {
				if (ENVIRONMENT !== 'production' || !$recaptha->recapthaSecret || (new Recaptha())->verify($_POST['g-recaptcha-response'])) {
					$id = (new UserModel())->register($this->request->getPost());
					(new UserModel())->find($id)->sendVerifyEmail();
					if ($r = $this->request->getCookie('r')) {
						$this->response->deleteCookie('r');
					}
					return $this->response->redirect(base_url($r ?: 'user'));
				}
			}
			return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
		}
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
