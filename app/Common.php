<?php

use CodeIgniter\Entity;
use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

function find_with_filter(\CodeIgniter\Model $model, int $length = 500)
{
    $req = Services::request();
    $page = intval($req->getGet('page'));
    $size = intval($req->getGet('size'));
    $offset = intval($req->getGet('offset'));
    if ($size === 0) $size = $length;
    else if ($size < 0) $size = 0;
    if ($offset === 0)
        $offset = max(0, $page - 1) * $size;
    // if ($offset > 0)
    $c = $model->countAllResults(false);
    // getting the C makes this easier to reverse
    $o = $c - ($offset + 1) - ($c % $size);
    $r = $model->findAll($size + min(0, $o), max(0, $o));
    $r = array_reverse($r);
    // generate pagination
    $_SERVER['pagination'] = [
        'page' => ($size == 0 ? 0 : floor($offset / $size)) + 1,
        'max' => isset($c) ? ceil($c / $size) : ceil((count($r) + 1) / $size),
        'certain' => isset($c),
    ];
    return $r;
}

function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g')
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    return $url;
}

function get_excerpt($content, $length = 40, $more = '...')
{
    $excerpt = strip_tags(trim($content));
    $words = str_word_count($excerpt, 2);
    if (count($words) > $length) {
        $words = array_slice($words, 0, $length, true);
        end($words);
        $position = key($words) + strlen(current($words));
        $excerpt = substr($excerpt, 0, $position) . $more;
    }
    return $excerpt;
}

/**
 * @param string|null $file
 */
function post_file(Entity $entity, $name, string $folder = null)
{
    if (!is_dir($path  = WRITEPATH . implode(DIRECTORY_SEPARATOR, ['uploads', $folder ?? $name, '']))) {
        mkdir($path, 0775, true);
    }
    $req = Services::request();
    $file = $req->getFile($name);
    if ($file && $file->isValid() && $file->move($path)) {
        if ($entity->{$name} && is_file($path . $entity->{$name})) {
            unlink($path . $entity->{$name});
        }
        $entity->{$name} = $file->getName();
    } else if ($req->getPost('_' . $name) === 'delete') {
        if ($entity->{$name} && is_file($path . $entity->{$name})) {
            unlink($path . $entity->{$name});
        }
        $entity->{$name} = null;
    }
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function normHP($val)
{
    $val = str_replace(['+', '-', ' '], '', $val);
    if (substr($val, 0, 2) == '62') {
        $val = '0' . substr($val, 0, 2);
    }
    return $val;
}

function HP2WA($val)
{
    return 'https://wa.me/62' . substr($val, 0, 1);
}

function startsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}
function endsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}